<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy("name", "ASC")->select(["name", "id"])->pluck("name", "id");
        $faker = Faker::create();
        $fake_contact = [
            "first_name" => request()->old("first_name", $faker->firstName()),
            "last_name" => request()->old("last_name", $faker->lastName()),
            "phone" => request()->old("phone", $faker->phoneNumber()),
            "email" => request()->old("email", $faker->email()),
            "address" => request()->old("address", $faker->address()),
            // "company_id" => request()->old("company_id",  Company::first()->pluck("id")->random()),
            "company_id" => request()->old("company_id",  -1),
        ];
        return view("contacts/create", ["companies" => $companies, "contact" => $fake_contact]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route("contacts.index")->with("message", "Contact has been added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $contact = Contact::findOrFail($id);
        $contact = DB::table("contacts")
            // ->join("companies", "contacts.id", "=", "companies.id")
            ->join("companies", function ($join) use ($id) {
                $join->on("contacts.company_id", "=", "companies.id")
                    ->where("contacts.id", "=", $id);
            })
            ->select("contacts.*", "companies.name")->first();
        // abort_if(!isset($contacts[$id]), 404);
        // abort_unless(!empty($contact), 404);
        // return view("contacts/show")->with("contact", $contact);
        return view("contacts/show", ["contact" => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::orderBy("name", "ASC")->select(["name", "id"])->pluck("name", "id");
        // $contact = Contact::findOrFail(6);
        $contact = Contact::where("id", "=", $id)->first();

        abort_if($contact == null, 404, "No contact$contact with id: " . $id);

        $contact = [
            "id" => $contact["id"],
            "first_name" => request()->old("first_name", $contact["first_name"]),
            "last_name" => request()->old("last_name", $contact["last_name"]),
            "phone" => request()->old("phone", $contact["phone"]),
            "email" => request()->old("email", $contact["email"]),
            "address" => request()->old("address", $contact["address"]),
            "company_id" => request()->old("company_id",  $contact["company_id"]),
        ];

        return view("contacts/edit", ["companies" => $companies, "contact" => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "first_name" => "required|string|max:50",
            "last_name" => "required|string|max:50",
            "email" => "required|email",
            "phone" => "nullable",
            "address" => "nullable",
            "company_id" => "required|exists:companies,id"
        ]);
        Contact::updateOrCreate([
            "first_name" => $request["first_name"],
            "last_name" => $request["last_name"],
            "email" => $request["email"],
            "phone" => $request["phone"],
            "address" => $request["address"],
            "company_id" => $request["company_id"]
        ]);
        return redirect()->route("contacts.show", $id)->with("message", "Contact has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
