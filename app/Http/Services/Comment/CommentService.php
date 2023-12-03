<?php

namespace App\Http\Services\Comment;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService implements ICommentService
{
    public function store(array $data, Blog $blog)
    {
        $comment = new Comment([
            'content' => $data['content'],
        ]);

        $comment->user()->associate(Auth::user());
        $comment->blog()->associate($blog);
        $comment->save();

        return $comment;
    }
}
