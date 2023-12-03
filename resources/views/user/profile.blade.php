@vite('resources/css/profile.css')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
<div class="user-profile-container">
    <h2>User Profile</h2>

    @if($user->image != null)
        <img src="{{ asset('storage/'. $user->image )}}" alt="Profile Image">
    @else
        <form id="image-upload-form" action="{{ url('/upload/'. $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image">
            <button type="submit">Upload Image</button>
        </form>
    @endif

    <a href="{{route('blog_add_form')}}">Create a blog</a>
</div>

<div>
    <h1>Blog Search</h1>
    <form method="post" action="/search">
        @csrf
        <label for="query">Search:</label>
        <input type="text" id="query" name="query" required>
        <button type="submit">Search</button>
    </form>
</div>

<div>
    <h2>Blogs</h2>
    @foreach($blogs as $blog)
        <div>
            <h2>{{ $blog->name }}</h2>
            <p>{{ $blog->description }}</p>

            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image">
            @endif

            <div style="margin-bottom: 20px;">
                <h2>Comments:</h2>
                @if($blog->comments)
                    @foreach($blog->comments as $comment)
                        <p>{{ $comment->content }}</p>
                    @endforeach
                @endif

                <form action="{{route('comments.store',$blog)}}" method="post" style="margin-top: 20px;">
                    @csrf
                    <label for="content" style="display: block; margin-bottom: 5px;">Add a comment:</label>
                    <textarea name="content" id="content" rows="3" style="width: 100%; margin-bottom: 10px;"></textarea>
                    @if ($errors->has('content'))
                        @error('content')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    @endif
                    <button type="submit" style="background-color: deepskyblue; color: white; padding: 10px;">Submit Comment</button>
                </form>
            </div>
        </div>
    @endforeach

    <div class="profile-actions">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
</body>
</html>

