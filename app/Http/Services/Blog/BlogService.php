<?php

namespace App\Http\Services\Blog;

use App\Models\Blog;

class BlogService implements IBlogService
{
    public function store(array $data)
    {
        $blog = Blog::create($data);

        $blogImage = $data['image'];

        $extension = $data['image']->getClientOriginalExtension();
        $imageName = 'uploaded_' . time() . '.' . $extension;

        $blogImage->storeAs('public', $imageName);

        $blog->image = $imageName;

        $blog->save();

        return $blog;
    }
}
