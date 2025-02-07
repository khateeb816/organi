<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function showMessages()
    {
        $messages = Contact::latest()->get();
        return view('backend.admin.contact.index', compact('messages'));
    }

    public function showMessageDetails($id)
    {
        $message = Contact::find($id);
        $message->status = 1;
        $message->save();
        return view('backend.admin.contact.view', compact('message'));
    }




    public function deleteMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully');
    }
}
