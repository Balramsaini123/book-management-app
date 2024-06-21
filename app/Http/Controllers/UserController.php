<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\UserService;

/**
 * Class UserController
 *
 * Controller responsible for managing user-related operations such as registration, login, and dashboard for authors.
 *
 * @package App\Http\Controllers
 */

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
      /**
     * Display the registration form for new authors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registeration()
    {
        return view('books-management.register_newauthor');
    }

    /**
     * Process the creation of a new author.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_author(CreateUserRequest $request)
    {
        
        $new_user = $this->userService->createUser($request);
        if ($new_user->role == 1) {
            return redirect()->route('login')->with('success', 'You have successfully registered. Please login.');
        } else {
            return redirect()->route('login')->with('success', 'Your author account is pending approval.');
        }
    }

    /**
     * Display the login form for authors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('books-management.login_author');
    }

    /**
     * Process the login request for authors.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login_author(LoginUserRequest $request)
    {

        $result = $this->userService->loginAuthor($request);

        return redirect()->route($result['redirect'])->with($result['status'], $result['message']);
    }

    /**
     * Display the dashboard for authors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        return view('books-management.author_dashboard');
    }

    /**
     * Log out the currently logged-in author.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logOut()
    {
        $this->userService->logOut();
        return redirect('login')->with('success', 'You have been logged out successfully.');
    }
}
