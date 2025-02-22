<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $users = User::with('roles')->get();
        // return $users;
        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function show($id) {
        // $user = User::with('roles', 'permissions')->find($id);
        $user = User::find($id);

        $userRoles = $user->getRoleNames();
        $userPermissions = $user->getPermissionsViaRoles()->pluck('name');

        return [
            'user' => $user,
            'userRoles' => $userRoles,
            'userPermissions' => $userPermissions,
        ];
    }

    public function create() {
        $roles = Role::all();

        return view('user.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request) {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'roles' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $roles = $request->only('roles');

        if($roles) {
            $user->syncRoles($roles);
        }

        return redirect('/users')->with('status', 'User created successfully');
    }

    public function edit($id) {

        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = DB::table('model_has_roles')
                        ->where('model_id', $user->id)
                        ->pluck('role_id', 'role_id')
                        ->all();

        return view('user.edit', [
            'roles' => $roles,
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }

    public function destroy(User $user) {
        // return $user;
        $user->delete();
        return redirect()->back()->with('status', 'Delete user successfully!');
    }

    public function update(Request $request, User $user) {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'roles' => ['required'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $roles = $request->only('roles');

        if ($roles) {
            $user->syncRoles($roles);
        }

        return redirect('/users')->with('status', 'User updated successfully');
    }



    public function updateUserPassword(Request $request, User $user)
    {
        // return $user;
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');

        // Check if the current password matches the password stored in the database for the user
        if (!Hash::check($currentPassword, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        return redirect('/users')->with('status', 'password-updated');
    }



}
