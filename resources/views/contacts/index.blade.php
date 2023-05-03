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
                                    <a href="{{ route('contacts.create') }}" class="btn btn-success">
                                        <i class="fa fa-plus-circle"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @include("contacts.filter") --}}
                            @include('contacts.filter', [
                                'companies' => $companies,
                                'company_count' => $company_count,
                            ])
                            @if ($message = session('message'))
                                <div class="alert alert-success">{{ $message }}
                                    @if ($undoRoute = session("undoRoute"))
                                        <form action="{{ $undoRoute}}" method="POST" style="display: inline">
                                            @csrf
                                            @method("delete")
                                            <button class="btn alert-link">Undo</button>
                                        </form>
                                    @endif
                                </div>
                            @endif
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
                                    @php
                                        $showTrashButtons = request()->query('trash') ? true : false
                                    @endphp
                                    @forelse ($contacts as $id => $contact)
                                        {{-- @includeIf ("contacts.contact", ["id" => $id, "contact" => $contact]) --}}
                                        <tr>
                                            <th scope="row">
                                                {{ ($contacts->currentPage() - 1) * PAGINATION_CONTACT + $loop->iteration }}
                                            </th>
                                            <td>{{ $contact->first_name }}</td>
                                            <td>{{ $contact->last_name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>
                                                @if (strlen($contact->email) > MAX_LEN_TEXT)
                                                    {{ substr($contact->email, 0, MAX_LEN_TEXT - 3) . '...' }}
                                                @else
                                                    {{ $contact->email }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (strlen($contact->company->name) > MAX_LEN_TEXT)
                                                    {{ substr($contact->company->name, 0, MAX_LEN_TEXT - 3) . '...' }}
                                                @else
                                                    {{ $contact->company->name }}
                                                @endif
                                            </td>
                                            <td width="150">
                                                @if ($showTrashButtons)
                                                    <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" style="display: inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-circle btn-outline-info" title="Restore"><i class="fa fa-undo"></i></button>
                                                    </form>
                                                    <form action="{{ route('contacts.force-delete', $contact->id) }}" onsubmit="return alert('Your data will be removed permanently. Are you sure?')" method="POST" style="display: inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently"><i class="fa fa-times"></i></button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Trash">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- @includeIf("contacts.empty") --}}
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

                            @include('contacts.paginator', ['paginator' => $contacts])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
