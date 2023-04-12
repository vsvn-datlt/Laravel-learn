@extends ("layouts.public")

@section('title', 'Contact App | All Contacts')
@section('logo_contact_app_ref', 'index')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-title">
                            <div class="d-flex align-items-center">
                                <h2 class="mb-0">All Contacts</h2>
                                <div class="ml-auto">
                                    <a href='{{ route('contacts.create') }}' class="btn btn-success"><i
                                            class="fa fa-plus-circle"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @include("contacts.filter") --}}
                            @include("contacts.filter", ["companies" => $companies, "company_count" => $company_count, ])
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contacts as $id => $contact)
                                        {{-- @includeIf ('contacts.contact', ['id' => $id, 'contact' => $contact]) --}}
                                        <tr>
                                            <th scope="row">
                                                {{ ($contacts->currentPage() - 1) * PAGINATION_CONTACT + $loop->iteration }}
                                            </th>
                                            <td>{{ $contact->first_name }}</td>
                                            <td>{{ $contact->last_name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->company->name }}</td>
                                            <td width="150">
                                                <a href="{{ route('contacts.show', $contact->id) }}"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-circle btn-outline-danger" title="Delete" onclick="confirm('Are you sure?')"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- @includeIf('contacts.empty') --}}
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-warning">
                                                    No contact found
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            @include("contacts.paginator", ["paginator" => $contacts])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
