<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog - Gestion</title>
</head>
<body>
    @foreach ($user as $u)
        <h4>{{ $u->id }}</h4>
        <h3>{{ $u->name }}</h3>
        <p>{{ $u->email }}</p>

        
        <a href="/gestion/removeAccount{{ $u->id }}">DELETE ACCOUNT</a>

        <hr>
    @endforeach

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>