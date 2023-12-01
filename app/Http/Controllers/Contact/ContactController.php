<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\contact\UpdateContactRequest;
use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // fecth all contacts
        $contacts=Contact::all();

        return view('contact.index', compact('contacts'));
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        // validation
        $data = $request->validated();
        

        // insert data
        $contact                = new Contact;
        $contact->first_name    = $data['first_name'];
        $contact->middle_name   = $data['middle_name'];
        $contact->last_name     = $data['last_name'];
        $contact->email_address = $data['email'];
        $contact->save();

        // redirect
        // return back();
        return redirect()->route('contacts.index')->with('status', 'Contact created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        // validation
        $data = $request->validated();
        

        // update data
        $contact->first_name    = $data['first_name'];
        $contact->middle_name   = $data['middle_name'];
        $contact->last_name     = $data['last_name'];
        $contact->email_address = $data['email'];
        $contact->save();

        // redirect
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // delete record
        $contact->delete();
        
        // redirect
        return redirect()->route('contacts.index')->with('status', 'Contact deleted successfully');
    }
}
