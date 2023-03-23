<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = $this->getContacts();
        $companies = $this->getCompanies();
        // return "<h1>All contacts</h1>";
        return view("contacts/index", ["contacts" => $contacts, "companies" => $companies]);
        // return view("contacts/index")->with("contacts", $contacts);
    }

    public function show($id)
    {
        $contacts = $this->getContacts();
        // abort_if(!isset($contacts[$id]), 404);
        abort_unless(isset($contacts[$id]), 404);
        $contact = $contacts[$id];
        // return "Contact " . $id;
        // return view("contacts/show");
        return view("contacts/show")->with("contact", $contact);
    }

public function create()
{
    return view("contacts/create");
}

    protected function getCompanies()
    {
        return [
            1 => ["name" => "Company One", "contacts" => 3409647897],
            2 => ["name" => "Company Two", "contacts" => 8765679960],
            3 => ["name" => "Company Three", "contacts" => 8747964336]
        ];
    }

    protected function getContacts()
    {
        return [
            1 => ['first_name' => 'Alfred', "last_name" => "Kuhlman", "email" => "alfred@gmail.com", 'phone' => '7863510562', "company" => "Company One", "address" => "Lorem ipsum dolor"],
            2 => ['first_name' => 'Frederick', "last_name" => "Jerde", "email" => "frederick@gmail.com", 'phone' => '9465258086', "company" => "Company One", "address" => "Lorem ipsum dolor"],
            3 => ['first_name' => 'Joannie', "last_name" => "McLaughlin", "email" => "joannie@gmail.com", 'phone' => '2568876437', "company" => "Company Two", "address" => "Lorem ipsum dolor"],
            4 => ['first_name' => 'Odie', "last_name" => "Koss", "email" => "odie@gmail.com", 'phone' => '9896874639', "company" => "Company Two", "address" => "Lorem ipsum dolor"],
            5 => ['first_name' => 'Edna', "last_name" => "Ondricka", "email" => "edna@gmail.com", 'phone' => '4698596834', "company" => "Company Three", "address" => "Lorem ipsum dolor"],
        ];
    }
}
