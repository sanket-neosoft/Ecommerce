<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Render the All Users data.
     *
     * @return App\Models\User
     * @return App\Models\Role
     */
    public function getUsers()
    {
        return view('user_management', ['users' => User::all(), 'roles' => Role::all()]);
    }

    /**
     * Render the Add User form.
     *
     * @return App\Models\Role
     */
    public function addUserForm()
    {
        return view('add_user', ['roles' => Role::all()]);
    }

    /**
     * Returns the User data.
     *
     * @param $id
     * 
     * @return App\Models\User 
     */
    public function getUser($id)
    {
        return response()->json(User::find($id));
    }

    /**
     * Edit user details
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function editUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|alpha',
            'lname' => 'required|alpha',
            'role' => 'required',
        ], [
            'fname.required' => 'First name is required',
            'fname.alpha' => 'Only alphabets are allowed.',
            'lname.required' => 'Last name is required',
            'lname.alpha' => 'Only alphabets are allowed.',
            'role.required' => 'Select role'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $user = User::find($id);
            $user->firstname = $request->fname;
            $user->lastname = $request->lname;
            $user->role_id = $request->role;
            if ($request->active === 'active') {
                $user->active = true;
            } else {
                $user->active = false;
            }
            if ($user->save()) {
                return response()->json('success');
            }
            return redirect('/user-management')->with('status', 'success');
        }
    }

    /**
     * Insert Data in users table
     *
     * @param Illuminate\Http\Request $request
     * 
     * @return session('status') = 'success' or 'failed'
     */
    public function addUser(Request $request)
    {
        $validator = $request->validate([
            'fname' => 'required|alpha',
            'lname' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^[\w-]+$/|min:8|max:12|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ], [
            'fname.required' => 'First name is required',
            'fname.alpha' => 'Only alphabets are allowed.',
            'lname.required' => 'Last name is required',
            'lname.alpha' => 'Only alphabets are allowed.',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email address',
            'email.unique' => 'Email address is already taken',
            'password.required' => 'Password is required',
            'passowrd.regex' => 'Only alphanumeric characters are allowed',
            'password.min' => 'Minimum password length should be 8 characters',
            'password.max' => 'Maximum password length should be 12 characters',
            'password_confirmation.required' => 'Re-enter password',
            'password.confirmed' => 'Password does not match',
            'role.required' => 'Select role'
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
            $config = new Configuration();
            $config->user_id = $user->id;
            $config->notification_email = $request->email;
            return back()->with('status', 'success');
        } else {
            return back()->with('status', 'error');
        }
    }

    /**
     * Delete User.
     *
     * @param $id
     * 
     * @return void
     */
    public function deleteUser($id)
    {
        User::find($id)->delete();
    }

}
