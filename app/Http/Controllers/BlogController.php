<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Services\Blog\IBlogService;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected IBlogService $blogService;

    public function __construct(IBlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function create(BlogRequest $request)
    {
        $data = $request->validated();

        $this->blogService->store($data);

        return view('blog.create_success');
    }

    public function index()
    {
        return view('blog.create');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Blog::where('name', 'like', '%' . $query . '%')->get();

        return view('blog.search_results', [
            'results' => $results,
        ]);
    }
}

