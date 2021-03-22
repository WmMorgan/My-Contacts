<?php

namespace App\Http\Controllers;

use App\Models\ContactEmail;
use App\Models\ContactPhone;
use Illuminate\Http\Request;
use App\Models\Contact;
use Auth;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::where(['user_id' => Auth::id(),
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%')->get();
                }
            }]
        ])->orderBy("time", "desc")->paginate(5);


        return view('contact.index', compact('contact'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:contact,name,NULL,id,user_id,' . Auth::id() . '|max:25',
            'number' => 'required|unique:phone,number,NULL,id,user_id,' . Auth::id() . '|regex:/(^([99+]+)(\d+)?$)/u|max:13',
            'email' => 'required|email|unique:email,email,NULL,id,user_id,' . Auth::id()
        ]);
        $contact = Contact::create([
            'name' => $request->input('name'),
            'time' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::id(),
        ]);

        ContactPhone::create([
            'contact_id' => $contact->id, // Notice the family ID here
            'number' => $request->input('number'),
            'user_id' => Auth::id(),
        ]);
        ContactEmail::create([
            'contact_id' => $contact->id, // Notice the family ID here
            'email' => $request->input('email'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('contact.index')
            ->with('success', 'Contact created successfully.');

    }

    public function show(Contact $contact)
    {
        $phone = ContactPhone::where(['contact_id' => $contact->id])->get();
        $email = ContactEmail::where(['contact_id' => $contact->id])->get();

        return view('contact.show', compact('contact', 'phone', 'email'));
    }

    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|unique:contact,name,NULL,id,user_id,' . Auth::id() . '|max:25',
        ]);
        $contact->update($request->all());

        return redirect('/contact/' . $contact->id)
            ->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact_id = $contact->id;
        $contact->where(['user_id' => Auth::id(), 'id' => $contact_id])->delete();
        ContactPhone::where(['contact_id' => $contact_id, 'user_id' => Auth::id()])->delete();
        ContactEmail::where(['contact_id' => $contact_id, 'user_id' => Auth::id()])->delete();
        return redirect()->route('contact.index')
            ->with('success', 'Contact deleted successfully');
    }

    // Phone CRUD // Phone CRUD // Phone CRUD

    public function phonecreate($id)
    {
        return view('contact.phone.create', compact('id'));
    }

    public function phonestore(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|unique:phone,number,NULL,id,user_id,' . Auth::id() . '|regex:/(^([99+]+)(\d+)?$)/u|max:13',
        ]);

        ContactPhone::create([
            'contact_id' => $id, // Notice the family ID here
            'number' => $request->input('number'),
            'user_id' => Auth::id(),
        ]);

        return redirect('/contact/' . $id)
            ->with('success', 'Phone Number created successfully.');

    }

    public function phoneedit($id)
    {
        $phone = ContactPhone::where('id', $id)->get();
        return view('contact.phone.edit', compact('phone'));
    }

    public function phoneupdate(Request $request, ContactPhone $phone, $id)
    {
        $request->validate([
            'number' => 'required|unique:phone,number,NULL,id,user_id,' . Auth::id() . '|regex:/(^([99+]+)(\d+)?$)/u|max:13',
        ]);
        $phone->where('id', $id)
            ->update(['number' => $request->input('number')]);
        $tel_id = ContactPhone::where('id', $id)->get();
        return redirect('/contact/' . $tel_id[0]->contact_id)
            ->with('success', 'Contact updated successfully');
    }

    public function phonedestroy($id)
    {
        $tel_id = ContactPhone::where('id', $id)->get();
        ContactPhone::where(['id' => $id])->where(['user_id' => Auth::id()])->delete();


        return redirect('/contact/' . $tel_id[0]->contact_id)
            ->with('success', 'Contact deleted successfully');
    }


// E-mail CRUD // E-mail CRUD // E-mail CRUD

    public function mailcreate($id)
    {
        return view('contact.email.create', compact('id'));
    }

    public function mailstore(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:email,email,NULL,id,user_id,' . Auth::id()
        ]);

        ContactEmail::create([
            'contact_id' => $id, // Notice the family ID here
            'email' => $request->input('email'),
            'user_id' => Auth::id(),
        ]);

        return redirect('/contact/' . $id)
            ->with('success', 'E-mail address created successfully.');

    }

    public function mailedit($id)
    {
        $email = ContactEmail::where('id', $id)->get();
        return view('contact.email.edit', compact('email'));
    }

    public function mailupdate(Request $request, ContactEmail $email, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:email,email,NULL,id,user_id,' . Auth::id()
        ]);
        $email->where('id', $id)
            ->update(['email' => $request->input('email')]);
        $mail_id = ContactEmail::where('id', $id)->get();
        return redirect('/contact/' . $mail_id[0]->contact_id)
            ->with('success', 'E-mail address updated successfully');
    }

    public function maildestroy($id)
    {
        $mail_id = ContactEmail::where('id', $id)->get();
        ContactEmail::where(['id' => $id])->where(['user_id' => Auth::id()])->delete();


        return redirect('/contact/' . $mail_id[0]->contact_id)
            ->with('success', 'E-mail address deleted successfully');
    }

}



