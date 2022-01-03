<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    /**
     * Render the User email configuration.
     *
     * @return App\Models\User
     */
    public function getConfig()
    {
        return view('configuration_management', ['user' => User::find(Auth::user()->id)]);
    }

    /**
     * Edit User notification email id.
     *
     * @return App\Models\User
     */
    public function editConfig(Request $request) {
        $validator = $request->validate([
            'nemail' => 'required|email'
        ], [
            'nemail.required' => 'Email is required',
            'nemail.email' => 'Invalid email id',
        ]);
        if ($validator) {
            $config = Configuration::where('user_id', Auth::user()->id)->first();
            $config->notification_email = $request->nemail;
            $config->save();
            return back()->with('status', 'success');
        }
    }
}
