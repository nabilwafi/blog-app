<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contact_form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ContactController extends Controller
{
    public function index() {

        $contact = Contact::first();
        return view('layouts.pages.contact', compact('contact'));
    }

    public function contactForm(Request $request) {

        $validated = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]
        );

        $contact_form = new Contact_form();
        $contact_form->name = $request->name;
        $contact_form->email = $request->email;
        $contact_form->subject = $request->subject;
        $contact_form->message = $request->message;
        $contact_form->save();

        return redirect()->back()->with('success', 'Message inserted successfully');
    }

    public function messageContact() {

        $messages = Contact_form::latest()->paginate(5);
        return view('admin.contact.messages', compact('messages'));
    }
    
    public function adminIndex() {

        $contacts = Contact::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function addContact() {

        return view('admin.contact.create');
    }

    public function createContact(Request $request) {

        $validated = $request->validate([
            'address' => 'required|min:5',
            'email' => 'required',
            'phone' => 'required|max:255'
        ]
        );

        $contact = new Contact();
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();

        return redirect()->route('admin.contact')->with('success', 'Contact inserted successfully');
    }

    public function updateContact(Request $request, $id) {
        
        $contact = Contact::find($id);
        return view('admin.contact.update', compact('contact'));
    }

    public function editContact(Request $request, $id) {
        
        $validated = $request->validate([
            'address' => 'required|min:5',
            'email' => 'required',
            'phone' => 'required|max:255'
        ]
        );

        $contact = Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect()->route('admin.contact')->with('success', 'Contact updated successfully');
    }

    public function deleteContact($id) {
        $contact = Contact::find($id)->delete();

        return redirect()->route('admin.contact')->with('success', 'Contact deleted successfully');
    }

}
