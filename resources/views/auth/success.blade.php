@vite('resources/css/profile.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h2>{{$message}}</h2>
<a href="{{ route('loginForm') }}">Back to Login page</a>
</body>
</html>

