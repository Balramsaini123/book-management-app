<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

/**
 * Class UserService
 *
 * This class provides service methods for user management, including
 * user creation, author login, and user logout functionalities.
 *
 * @package App\Services
 */
class UserService {
    
    /**
     * The User repository instance.
     *
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository The User repository implementation.
     */
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user.
     *
     * @param Request $request The HTTP request containing user data.
     * @return \Illuminate\Database\Eloquent\Model The created user object.
     */
    public function createUser(Request $request) {
        $request->validated();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];

        $data['password'] = Hash::make($data['password']);
        
        if ($data['role'] == 1) {
            $data['status'] = "1"; // Set account status to pending for author role
        }

        return $this->userRepository->create($data);
    }

    /**
     * Attempt to log in an author.
     *
     * @param Request $request The HTTP request containing login credentials.
     * @return array Login status and redirect information.
     */
    public function loginAuthor(Request $request) {
        $request->validated();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status == 1) {
                return [
                    'status' => 'success',
                    'message' => 'You signed in successfully',
                    'redirect' => 'dashboard'
                ];
            } elseif ($user->status == 0) {
                Session::flush();
                Auth::logout();
                return [
                    'status' => 'error',
                    'message' => 'Your author account is not approved',
                    'redirect' => 'login'
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Your login credentials do not match',
            'redirect' => 'login'
        ];
    }

    /**
     * Log out the currently authenticated user.
     *
     * @return void
     */
    public function logOut() {
        Session::flush();
        Auth::logout();
    }
}
