<?php

namespace App\Http\Services\Comment;

use App\Models\Blog;

interface ICommentService
{
    public function store(array $data, Blog $blog);
}
