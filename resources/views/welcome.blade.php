<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel learn</title>
</head>

<body>
    <h1>My Contact app</h1>
    <!-- <a href="' . route(" contacts.index") . '">All contacts</a>
    <a href="' . route("contacts.create") . '">Add new contact</a>
    <a href="' . route("contacts.show", 1) . '">Show contact</a> -->

    {{ date('D d-M-y') }}

    <br />
    {{ 3 + 7}}
    <br />

    {!! "<h3>Hello</h3>" !!}

    <?= "<h3>Hello</h3>" ?>
    <h2>
        Hello @{{ name }}
    </h2>

    @php
    $message = "Hello world";
    @endphp

    <h2>{{ $message }}</h2>
    {{-- This is a comment --}}

</body>

</html>