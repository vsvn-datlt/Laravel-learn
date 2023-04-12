{{-- <select class="custom-select" id="company-select" name="company_id">
    <option value="" selected>All Companies</option>
    @foreach ($company_count as $id => $company)
        <option value="{{ $id }}" @if (intval(request()->query('company_id')) == $id) selected @endif>
            {{ $company }}
        </option>
    @endforeach
</select> --}}
<select class="custom-select" name="company_id" id="search-select" onchange="this.form.submit()">
    <option value="" selected>All Companies</option>
    @foreach ($company_count as $id => $company)
        <option value="{{ $id }}" @if ($id == intval(request()->query('company_id'))) selected @endif>
            {{ $company }}
        </option>
    @endforeach
</select>
