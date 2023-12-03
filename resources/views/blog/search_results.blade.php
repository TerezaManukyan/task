@vite('resources/css/profile.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h2>Search results</h2>

@foreach($results as $result)
    <p>{{$result->name}}</p>
    <p>{{$result->description}}</p>
    <img src="{{ asset('storage/' . $result->image) }}" alt="Blog Image">
@endforeach
</body>
</html>
