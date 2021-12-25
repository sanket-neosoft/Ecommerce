<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    /**
     * Render the All Users data.
     *
     * @return App\Models\User
     */
    public function getUsers() {
        return view('user_management', ['users' => User::all()]);
    }
    /**
     * Render the Add User form.
     *
     * @return App\Models\Role
     */
    public function addUserForm() {
        return view('add_user', ['roles' => Role::all()]);
    }

    /**
     * Insert Data in users table
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function addUser(Request $request) {
        $validator = $request->validate([
            'fname' => 'required|alpha',
            'lname' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^[\w-]+$/|min:8|max:12',
            'password_confirmation' => 'required',
            'role' => 'required',
        ], [
            'fname.required' => 'Please enter first name',
            'fname.alpha' => 'Only alphabets are allowed.',
            'lname.required' => 'Please enter last name',
            'lname.alpha' => 'Only alphabets are allowed.',
            'email.required' => 'Please enter email',
            'email.email' => 'Invalid email address',
            'email.unique' => 'Email address is already taken',
            'password.required' => 'Please enter password',
            'passowrd.regex' => 'Only alphanumeric characters are allowed',
            'password.min' => 'Minimum password length should be 8 characters',
            'password.max' => 'Maximum password length should be 12 characters',
            'password_confirmation.required' => 'Please re-enter password',
            // 'password_confirmation.confirmed' => 'Password does not match',
            'role' => 'Please select role'
        ]);
        if ($validator) {
            $user = new User();
            $user->firstname = $request->fname;
            $user->lastname = $request->lname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role;
            if ($request->active === 'active') {
                $user->active = true;
            } else {
                $user->active = false;
            }
            $user->save();
            return back()->with('status', 'success');
        } else {
            return back()->with('status', 'error');
        }
    }
}
