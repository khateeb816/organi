<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $contactMessage = new Contact();
        $contactMessage->user_id = auth()->id(); // Instead of $request->user_id
        $contactMessage->name = $request->name;
        $contactMessage->subject = $request->subject;
        $contactMessage->message = $request->message;
        $contactMessage->save();

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
