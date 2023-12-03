<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Blog\IBlogRepository;
use App\Http\Repositories\User\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    protected IUserRepository $userRepository;
    protected IBlogRepository $blogRepository;

    public function __construct(IUserRepository $userRepository, IBlogRepository $blogRepository)
    {
        $this->userRepository = $userRepository;
        $this->blogRepository = $blogRepository;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,svg,pdf',
        ]);

        $image = $request->file('image');

        $extension = $image->getClientOriginalExtension();
        $imageName = 'uploaded_' . time() . '.' . $extension;

        $image->storeAs('public', $imageName);

        $userId = $request->route()->parameter('id');

        $user = $this->userRepository->getUserById($userId);

        $user->image = $imageName;

        $user->save();

        $blogs = $this->blogRepository->getAll();

        return Redirect::route('profile')->with([
            'user' => $user,
            'blogs' => $blogs
        ]);
    }

    public function profile(Request $request)
    {
        $user = session('user');
        $blogs = session('blogs');

        return view('user.profile')->with([
            'blogs' => $blogs,
            'user' => $user,
        ]);
    }
}

