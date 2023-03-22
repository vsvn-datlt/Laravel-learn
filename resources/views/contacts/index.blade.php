@extends ("layouts.main")

@section("title", "Contact App | All Contacts")

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
                                <a href='{{ route("contacts.create") }}' class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- @include("contacts.filter") --}}
                        @include("contacts.filter", ["companies" => $companies])
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
                                {{-- <?php if (!empty($contacts)) : ?> --}}
                                {{-- @if (!empty($contacts)) --}}
                                {{-- <?php foreach ($contacts as $id => $contact) : ?> --}}
                                {{-- @foreach ($contacts as $id => $contact) --}}
                                @forelse ($contacts as $id => $contact)
                                {{-- @continue($id == 1) --}}
                                {{-- @break($id == 3) --}}
                                <tr>
                                    <th scope="row">{{ $loop->index }}</th>
                                    <td>{{ $contact['first_name'] }}</td>
                                    <td>{{ $contact['last_name'] }}</td>
                                    <td>{{ $contact['phone'] }}</td>
                                    <td>{{ $contact['email'] }}</td>
                                    <td>{{ $contact['company'] }}</td>
                                    <td width="150">
                                        <a href="{{ route('contacts.show', $id) }}"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-circle btn-outline-danger" title="Delete" onclick="confirm('Are you sure?')"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                {{-- <?php endforeach ?> --}}
                                {{-- @endforeach --}}
                                {{-- <?php else : ?> --}}
                                {{-- @else --}}
                                @empty
                                <p>No contact found</p>
                                {{-- <?php endif ?> --}}
                                {{-- @endif --}}
                                @endforelse
                            </tbody>
                        </table>

                        <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection