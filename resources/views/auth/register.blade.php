@vite('resources/css/form.css')

<!DOCTYPE html>
<html lang="en">
<body>
<form action="{{ route('register') }}" method="post">
    @csrf
    <h2>Registration Form</h2>

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{old('name')}}">
        @if ($errors->has('name'))
            @error('name')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <div>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}">
        @if ($errors->has('last_name'))
            @error('last_name')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="{{old('email')}}">
        @if ($errors->has('email'))
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        @if ($errors->has('password'))
            @error('password')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <label for="password_confirmation">Password confirmation:</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    @if ($errors->has('password_confirmation'))
        @error('password_confirmation')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    @endif

    <input type="submit" value="Register">
</form>
</body>
</html>

