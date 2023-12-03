<?php

namespace App\Http\Repositories\Blog;

use App\Models\Blog;

class BlogRepository implements IBlogRepository
{
    public function getAll()
    {
        return Blog::all();
    }
}
