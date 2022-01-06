<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * Insert data in Contact us
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'numeric|digits:10|required',
            'message' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid Email address',
            'contact.required' => 'Contact number is required',
            'contact.numeric' => 'Alphabets are not allowed',
            'contact.digits' => 'Invalid contact number',
            'message.required' => 'Message is required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } else {
            $contactus = new ContactUs();
            $contactus->name = $request->name;
            $contactus->email = $request->email;
            $contactus->contact_number = $request->contact;
            $contactus->message = $request->message;
            if ($contactus->save()) {
                return response()->json(['message' => 'Your Message submitted Successfully'], 201);
            }
        }
    }
}
