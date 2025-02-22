<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use DB;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        // $this->middleware('permission:update user', ['only' => ['edit', 'update', 'updateUserPassword']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::with('roles')->paginate(10);
        // // return $users;
        // return view('admin.users.index', [
        //     'users' => $users,
        // ]);
        $users = User::with('roles')->paginate(10);
        // return $users;
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $authUser = $request->user();
        // return $authUser;
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'roles' => ['required'],
            'started_at' => 'nullable|date',
            'expired_at' => 'nullable|date|after:started_at',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'add_by_user_id' => $request->user()->id,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
        ]);

        $roles = $request->only('roles');

        if($roles) {
            $user->syncRoles($roles);
        }

        // if($authUser->shop_id == null) {
        //     $createdShop = Shop::create([
        //         'name' => $request->name . ' Shop',
        //         'owner_user_id' => $user->id,
        //         'description' => 'Your shop description'
        //     ]);

        //     if ($createdShop) {
        //         // Update the user's shop_id
        //         $user->update([
        //             'shop_id' => $createdShop->id,
        //         ]);
        //     }
        // }else {
        //     $user->update([
        //         'shop_id' => $authUser->shop_id,
        //     ]);
        // }


        return redirect('/admin/users')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('view user', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {

        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = DB::table('model_has_roles')
                        ->where('model_id', $user->id)
                        ->pluck('role_id', 'role_id')
                        ->all();

        return view('admin.users.edit', [
            'roles' => $roles,
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'roles' => ['required'],
            'started_at' => 'nullable|date',
            'expired_at' => 'nullable|date',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
        ]);

        $roles = $request->only('roles');

        if ($roles) {
            $user->syncRoles($roles);
        }

        return redirect('admin/users')->with('success', 'User Updated Successfully');
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

        return redirect('admin/users')->with('success', 'Password Updated Successfully!');
    }
    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Delete Successful!');
    }
}
