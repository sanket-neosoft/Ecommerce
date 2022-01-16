<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * Insert data in Contact us
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactUsApi(Request $request)
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
                $data = ['msg' => 'We appreciate you for contacting us. We recevied your message. Please be patient until reach upto you.'];
                $user['to'] = $request->email;
                Mail::send('mail.message',$data, function ($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('Your Message Registered');
                });
                return response()->json(['message' => 'Your Message submitted Successfully'], 201);
            }
        }
    }

    /**
     * Render the All Contact Us Details.
     *
     * @return view
     */
    public function getInbox()
    {
        return view('inbox', ['messages' => ContactUs::orderBy('created_at', 'DESC')->get()]);
    }

    /**
     * Render the readinbox Details.
     *
     * @return view
     */
    public function readInbox($id)
    {
        return view('read_mail', ['message' => ContactUs::find($id)]);
    }

    /**
     * send reply
     *
     * @return view
     */
    public function sendReply(Request $request)
    {
        $validator = $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ], [
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
        ]);
        if ($validator) {
            $data = ['msg' => $request->message];
            $user['to'] = $request->email;
            $user['subject'] = $request->subject;
            Mail::send('mail.message', $data, function ($message) use ($user) {
                $message->to($user['to']);
                $message->subject($user['subject']);
            });
            $message = ContactUs::find($request->id);
            $message->reply = true;
            if ($message->save()) {
                return redirect('/inbox')->with(['status' => 'Replied to ' . $request->email]);
            } else {
                return back()->with(['status' => 'Failed to Replied']);
            }
        }
    }
}
