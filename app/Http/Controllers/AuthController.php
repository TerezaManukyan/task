<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Blog\IBlogRepository;
use App\Http\Repositories\User\IUserRepository;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\User\IUserService;
use App\Mail\EmailChange;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected IUserService $userService;
    protected IUserRepository $userRepository;
    protected IBlogRepository $blogRepository;

    public function __construct(IUserService $userService, IUserRepository $userRepository, IBlogRepository $blogRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->blogRepository = $blogRepository;
    }

    public function registrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();

        $this->userService->store($userData);

        return view('auth.success')->with([
            'message' => 'User is registered successfully',
        ]);
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $userData = $request->validated();

        if (Auth::attempt($userData)) {
            $blogs = $this->blogRepository->getAll();

            $user = $this->userRepository->getUserByEmail($userData['email']);

            return view('user.profile')->with([
                'user' => $user,
                'blogs' => $blogs,
            ]);
        }

        return view('auth.wrong_credentials');
    }

    public function fillEmailPasswordReset()
    {
        return view('auth.fill_email_password_reset');
    }

    public function sendEmailPasswordReset(EmailRequest $request)
    {
        $email = $request->validated('email');

        $user = $this->userRepository->getUserByEmail($email);

        $request->session()->put('email', $email);

        if ($user) {
            Mail::to($user->email)->send(new PasswordReset());

            return view('auth.success')->with([
                'message' => 'Email is sent successfully'
            ]);
        } else {
            return "User with this email doesn't exist";
        }
    }

    public function passwordResetForm()
    {
        return view('auth.password_reset');
    }

    public function passwordReset(PasswordResetRequest $request)
    {
        $data = $request->validated();

        $email = $request->session()->get('email');

        $user = $this->userRepository->getUserByEmail($email);

        $user->password = Hash::make($data['password']);
        $user->save();

        return view('auth.success')->with([
            'message' => 'Password is changed successfully',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginForm');
    }

    public function changeEmailForm()
    {
        return view('auth.email_change_form');
    }

    public function fillEmailChangeEmail()
    {
        return view('auth.fill_email_email_change');
    }

    public function sendEmailChangeEmail(EmailRequest $request)
    {
        $email = $request->validated('email');

        $user = $this->userRepository->getUserByEmail($email);

        $request->session()->put('email', $email);

        if ($user) {
            $code = sprintf('%04d', rand(1000, 9999));
            $expiration = now()->addMinutes(30);

            $request->session()->put(['expires_at' => $expiration]);
            $request->session()->put(['code' => $code]);
            $request->session()->put(['old_email', $email]);

            Mail::to($user->email)->send(new EmailChange($code));
        } else {
            return "User with this email doesn't exist";
        }
    }

    public function changeEmail(EmailRequest $request)
    {
        $oldEmail = $request->session()->get('email');
        $user = $this->userRepository->getUserByEmail($oldEmail);

        if (!$user) {
            abort('404');
        }

        $code = $request->session()->get('code');
        $expiration = $request->session()->get('expires_at');

        $user->email_change_code = $code;
        $user->email_change_code_expires_at = $expiration;
        $user->email = $request->validated(['email']);
        $user->save();

        return view('auth.success')->with([
            'message' => 'Email is changed successfully'
        ]);
    }
}
