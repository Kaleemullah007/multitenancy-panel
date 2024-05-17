<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Mail\SentReply;
use App\Models\Reply;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->withCount('replies')->paginate();
        if ($contacts->lastPage() >= request('page')) {
            return view('contacts.index', compact('contacts'));
        }
        return to_route('contact.index', ['page' => request('page')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.reply');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {

        Contact::Create($request->validated());
        return redirect()->back()->with('message', 'Administrator will contact with you soon')->withFragment('contact');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {

        $replies = Reply::with('receiver')->where('receiver_id', $contact->id)->get();

        return view('contacts.reply', compact('contact', 'replies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {

        $contact->replied = 1;
        $contact->save();

        // dd($request->validated(), $contact);

        $reply = Reply::create($request->validated());

        Mail::to($contact->email)->send(new SentReply($reply));

        session()->flash('message', __('contact.message.save-message'));
        session()->flash('error', 'success');
        return to_route('contacts.index', ['page' => request('page')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}