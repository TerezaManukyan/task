@vite('resources/css/form.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
<body>
<form action="{{route('login')}}" method="post">
    @csrf
    <h2>Login Form</h2>

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
    <input type="submit" value="Login">

    <div>
        <a href="{{route('fillEmailPasswordReset')}}">Forgot Password</a>
        <a style="margin-left: 100px"  href="{{route('registrationForm')}}">Sign up</a>
        <a style="margin-left: 50px" href="{{route('fillEmailChangeEmail')}}">Change Email</a>
    </div>
</form>

<div>
    <a href="{{route('blog_add_form')}}">Create a blog</a>
</div>
</body>
</html>

