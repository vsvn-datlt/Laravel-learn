
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel learn</title>
</head>

<body>
    <h1>Contacts.Index View</h1>
    <a href=' {{ route("contacts.create") }}'>Add new contact</a>
    <a href='{{ route("contacts.show", 1) }}'>Show contact</a>

</body>

</html>