<select class="custom-select">
    <option value="" selected>All Companies</option>
    @foreach ($companies as $id => $company)
        <option value="{{ $id }}">{{ $company['name'] }} </option>
    @endforeach
</select>
