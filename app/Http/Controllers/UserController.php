<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function hidding_user(Request $request)
    {
        // $users = User::get();
        // return view('role-permission.user.index', [
        //     'users' => $users
        // ]);

        $query_param = [];

        $users = User::when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('id', 'like', "%{$value}%");
                }
            });
        })->get();

        $query_param = $request->has('search') ? ['search' => $request['search']] : [];

        return view('role-permission.user.hidden', compact('users', 'query_param'));
    }

    public function index(Request $request)
    {
        // $users = User::get();
        // return view('role-permission.user.index', [
        //     'users' => $users
        // ]);

        $query_param = [];

        $users = User::when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('id', 'like', "%{$value}%");
                }
            });
        })->get();

        $query_param = $request->has('search') ? ['search' => $request['search']] : [];

        return view('role-permission.user.index', compact('users', 'query_param'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.user.create', [
            'roles' => $roles
        ]);
    }

    public function uploadImage($image)
    {
        $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('storage/uploads/all_photo'), $imageName);
        return $imageName;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:4|max:20',
            'roles' => 'nullable',
        ]);

        // Create a new User instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        // Set ishidden attribute based on the request
        $user->ishidden = $request->has('ishidden') ? 1 : 0;

        if ($request->hasFile('image')) {
            $user->image = $this->uploadImage($request->file('image'));
        }

        // Save the user
        $user->save();

        // Sync roles
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Created Successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:4|max:20',
            'roles' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Adjust validation rules for image uploads
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'ishidden' => $request->ishidden == 'on' ? 1 : 0,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        if ($request->hasFile('image')) {
            $user->image = $this->uploadImage($request->file('image'));
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Updated Successfully.');
    }


    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users');
    }
}
