<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        // $companies = $this->getCompanies();
        $companies = Company::orderBy("name", "ASC")->pluck("name", "id");
        // return "<h1>All contacts</h1>";
        return view("contacts/index", ["contacts" => $contacts, "companies" => $companies]);
        // return view("contacts/index")->with("contacts", $contacts);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        // abort_if(!isset($contacts[$id]), 404);
        // abort_unless(!empty($contact), 404);
        return view("contacts/show")->with("contact", $contact);
    }

    public function create()
    {
        return view("contacts/create");
    }
}
