@vite('resources/css/form.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Password Reset</title>
<body>
<form action="{{ route('changeEmail') }}" method="post">
    @csrf
    <h2>Change email</h2>

    <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">

        @error('email')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>

    <input type="submit" value="Change">
</form>

</body>
</html>



