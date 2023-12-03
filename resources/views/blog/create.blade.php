@vite('resources/css/form.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<form action="{{ route('createBlog') }}" method="post" enctype="multipart/form-data">
    @csrf
    <h2>Create a blog</h2>

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
            @error('name')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="{{ old('description') }}">
        @if ($errors->has('description'))
            @error('description')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <div>
        <label for="image">Image:</label>
        <input type="file" name="image">
        @if ($errors->has('image'))
            @error('image')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        @endif
    </div>

    <input type="submit" value="Create" style="width: auto">
</form>

</body>
</html>


