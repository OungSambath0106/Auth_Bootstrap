<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index(Request $request)
    {
        $users = User::get();
        return view('role-permission.user.index', [
            'users' => $users
        ]);
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
        $image->move(public_path('storage/uploads/users_photo'), $imageName);
        return $imageName;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|string|max:100|unique:users,email',
            'password' => 'required|string|min:4|max:20',
            'roles' => 'nullable',
        ]);

        // Create a new User instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        // Set ishidden attribute based on the request
        // $user->ishidden = $request->has('ishidden') ? 1 : 0;

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
            'name' => 'required|string|min:4|max:25',
            'password' => 'nullable|string|min:4|max:20',
            'roles' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Adjust validation rules for image uploads
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            // 'ishidden' => $request->ishidden == 'on' ? 1 : 0,
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

        // Check if the user has an image
        if ($user->image) {
            // Get the image path
            $imagePath = public_path('storage/uploads/users_photo/' . $user->image);

            // Check if the file exists
            if (file_exists($imagePath)) {
                // Attempt to delete the file
                if (unlink($imagePath)) {
                    // File deleted successfully
                    // Proceed to delete the user
                    $user->delete();
                    return redirect('/users');
                } else {
                    // Error occurred while deleting the file
                    // Handle the error or log it for further investigation
                    dd('Error: Unable to delete file');
                }
            } else {
                // File does not exist at the specified path
                // Handle this case accordingly
                dd('Error: File does not exist');
            }
        } else {
            // User does not have an image
            // Proceed to delete the user without attempting to delete the image
            $user->delete();
            return redirect('/users');
        }
    }

    public function updateIshidden(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->ishidden = $user->ishidden == 1 ? 0 : 1;
            $user->save();

            $output = ['status' => 1, 'message' => __('Status updated'), 'ishidden' => $user->ishidden];

            DB::commit();
        } catch (Exception $e) {
            $output = ['status' => 0, 'message' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
