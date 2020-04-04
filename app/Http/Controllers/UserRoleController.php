<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of all users and their roles
     */
    public function index()
    {
        $users = User::with(['roles'])->get();

        return view('pages.user-roles.index', compact('users'));
    }

    /**
     * Assigns a role to a user
     */
    public function assignRoleForm()
    {
        $users = User::get();

        $roles = Role::get();

        return view('pages.user-roles.create',
            compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->roles()->attach($request->role_id);

        $assignedRole = Role::whereId($request->role_id)->first();

        session()->flash('success', 'Role ' . $assignedRole->name . ' Was assigned to ' . $user->full_name);

        return redirect()->route('user.roles.index');
    }
}
