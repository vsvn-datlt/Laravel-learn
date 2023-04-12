@extends('layouts.public')

@section('title', 'Contact App | Create New Contacts')

@section('logo_contact_app_ref', 'index')

@section('content')
    {{-- content --}}
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Add New Contact</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('contacts.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-3 col-form-label">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $fake_contact['first_name'] }}">
                                                @error('first_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">
                                                        Please enter first name.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-3 col-form-label">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $fake_contact['last_name'] }}">
                                                @error('last_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">
                                                        Please enter last name.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $fake_contact['email'] }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">
                                                        Please enter email.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-md-3 col-form-label">Phone</label>
                                            <div class="col-md-9">
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $fake_contact['phone'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-3 col-form-label">Address</label>
                                            <div class="col-md-9">
                                                <textarea name="address" id="address" rows="3" class="form-control">{{ $fake_contact['address'] }}"</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company_id" class="col-md-3 col-form-label">Company</label>
                                            <div class="col-md-9">
                                                <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                                    <option value="">Select Company</option>
                                                    @foreach ($companies as $id => $company)
                                                        <option value="{{ $id }}"@if ($fake_contact['company_id'] == $id) selected @endif>
                                                            {{ $company }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('company_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">
                                                        Please select company.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-9 offset-md-3">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="{{ route('contacts.index') }}"
                                                    class="btn btn-outline-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
