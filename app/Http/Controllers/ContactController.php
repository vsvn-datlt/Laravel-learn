<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;
use Faker\Factory as Faker;

class ContactController extends Controller
{
    public function index()
    {
        // $contacts = Contact::all();
        // $companies = $this->getCompanies();
        // $companies = Company::orderBy("name", "ASC")->pluck("name", "id");
        $companies = Company::orderBy("name", "ASC")->get();
        // return "<h1>All contacts</h1>";
        $data = [];
        foreach ($companies as $company) {
            $data[$company->id] = $company->name . "  (" . $company->contacts()->count() . ")";
        }
        // $contacts = Contact::latest()->paginate(PAGINATION_CONTACT);
        $contacts = Contact::latest()
            ->where(
                function ($query) {
                    if (request()->filled("company_id"))
                        $query->where("company_id", intval(request()->query("company_id")));
                }
            )
            ->where(
                function ($query) {
                    if (request()->filled("search"))
                        $query->where("first_name", "LIKE", "%" . request()->query("search") . "%")
                            ->orwhere("last_name", "LIKE", "%" . request()->query("search") . "%");
                }
            )
            ->paginate(PAGINATION_CONTACT);
        return view("contacts/index", ["contacts" => $contacts, "companies" => $companies, "company_count" => $data]);
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
        $companies = Company::orderBy("name", "ASC")->select(["name", "id"])->pluck("name", "id");
        $faker = Faker::create();
        // dd(request()->old());
        $fake_contact = [
            "first_name" => (request()->old("first_name") != null) ? request()->old("first_name") : $faker->firstName(),
            "last_name" => (request()->old("last_name") != null) ? request()->old("last_name") : $faker->lastName(),
            "phone" => (request()->old("phone") != null) ? request()->old("phone") : $faker->phoneNumber(),
            "email" => (request()->old("email") != null) ? request()->old("email") : $faker->email(),
            "address" => (request()->old("address") != null) ? request()->old("address") : $faker->address(),
            "company_id" => (request()->old("company_id") != null) ? request()->old("company_id") : Company::first()->pluck("id")->random(),
        ];
        return view("contacts/create", ["companies" => $companies, "fake_contact" => $fake_contact]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|max:50",
            "last_name" => "required|string|max:50",
            "email" => "required|email",
            "phone" => "nullable",
            "address" => "nullable",
            "company_id" => "required|exists:companies,id"
        ]);
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully');
    }
}
