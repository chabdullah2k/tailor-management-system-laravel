<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\customers;
use Illuminate\Mail\Mailables\Content;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contacts::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|max:15|unique:contacts,mobile',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Contacts::create($validated);

        return redirect()->route('contacts.index')->with('success', 'Contacts created successfully.');
    }


    public function edit($id)
    {
        $contact = Contacts::findOrFail($id);
        return view('admin.contacts.update', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|max:15|unique:contacts,mobile',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $contact = Contacts::findOrFail($id);
        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contacts updated successfully.');
    }


    public function destroy($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'contacts move to trash successfully.');
    }

    public function forceDelete($id)
    {
        $contact = Contacts::withTrashed()->findOrFail($id);
        $contact->forceDelete();

        return redirect()->route('contacts.index')->with('success', 'contacts permanently deleted.');
    }

    public function restoreView()
    {
        $contacts = Contacts::onlyTrashed()->get();
        return view('admin.contacts.restore', compact('contacts'));
    }

    public function restore($id)
    {
        $contact = Contacts::withTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('contacts.index')->with('success', 'contacts restored successfully.');
    }


    




}
