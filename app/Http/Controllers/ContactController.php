<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function index() {
        return view('contact');
    }

    public function create() {
        return view('contact');
    }


    public function store(Request $request) {
    // Form validation
      $request->validate( [
          'name' => 'required',
          'email' => 'required|email',
          'message' => 'required'
      ]);
        $contact = new Contact($request->all());
        $contact->save();

      //return avec un feedback
      return back()->with('success', 'Contact correctement enregistrer !');
  }
}
