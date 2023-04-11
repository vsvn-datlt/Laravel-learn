<select class="custom-select">
    <option value="" selected>All Companies</option>
    @foreach ($company_count as $id => $company)
        <option value="{{ $id }}">{{ $company }} </option>
    @endforeach
</select>
