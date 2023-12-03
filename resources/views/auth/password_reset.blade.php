@vite('resources/css/form.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Password Reset</title>
<body>
<form action="{{route('passwordReset')}}" method="post">
    @csrf
    <h2>Password Reset Form</h2>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    @if ($errors->has('password'))
        @error('email')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    @endif

    <label for="password_confirmation">Password confirm:</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    @if ($errors->has('password_confirmation'))
        @error('password_confirmation')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    @endif

    <input type="submit" value="Password Reset">
</form>
</body>
</html>


