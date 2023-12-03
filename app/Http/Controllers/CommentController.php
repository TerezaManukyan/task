<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Blog\IBlogRepository;
use App\Http\Requests\CommentRequest;
use App\Http\Services\Comment\ICommentService;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    protected IBlogRepository $blogRepository;
    protected ICommentService $commentService;

    public function __construct(IBlogRepository $blogRepository, ICommentService $commentService)
    {
        $this->blogRepository = $blogRepository;
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request, Blog $blog)
    {
        $data = $request->validated();

        $this->commentService->store($data, $blog);

        $blogs = $this->blogRepository->getAll();

        return Redirect::route('profile')->with([
            'user' => Auth::user(),
            'blogs' => $blogs
        ]);
    }
}
