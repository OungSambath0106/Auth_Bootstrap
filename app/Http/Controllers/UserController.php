<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20',
            'roles' => 'required'
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' =>Hash::make($request->password),
        // ]);
        
        // If validation passes, create a new User instance and save it
        $user = new User();
        $user->ishidden = $user == 'on' ? 1 : 0;
        $user->ishidden = $request->has('ishidden');
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password !== null) {
            // Hash the password before storing it
            $user->password = bcrypt($request->password);
        }

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Created Successfully with roles');
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
            'password' => 'nullable|string|min:6|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'ishidden' => $request->ishidden == 'on' ? 1 : 0, // Corrected line
        ];

        if (!empty($request->password))
        {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('satus', 'User Delete Successfully');
    }
}
