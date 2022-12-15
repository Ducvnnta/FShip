<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\ApiResponser;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * @var $userService
     */
    protected $userRepository;
    protected $userService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserServiceInterface $userService
    ) {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function registration()
    {
        return view('welcome');
    }

    public function viewlogin()
    {
        return view('web.login');
    }

    /**
     * Register user by email
     *
     */
    public function registerBE(RegisterUserRequest $request)
    {
        $result = $this->userService->registerUser($request);
        if (!$result) {
            $message = 'Unable To Register User.';
            $statusCode = Response::HTTP_BAD_REQUEST;

            return $this->errorResponse($message, $statusCode);
        }

        $message = 'Successfully register';
        $statusCode = Response::HTTP_OK;

        return $this->successResponse($result, $message, $statusCode);
    }

    /**
     * Register user by email
     *
     */
    public function register(RegisterUserRequest $request)
    {
        $result = $this->userService->registerUser($request);
        if (!$result) {
            $message = 'Unable To Register User.';
            $statusCode = Response::HTTP_BAD_REQUEST;

            return $this->errorResponse($message, $statusCode);
        }

        $message = 'Successfully register';
        $statusCode = Response::HTTP_OK;

        return back()->with('success', 'User created successfully.');
    }



    public function login()
    {
        $credentials = request(['email', 'password']);

        dd($this->submit);
        if($this->submit == 'register')
        {

        } elseif($this->submit == 'login')
        {

        }
        if (!$token = auth("admin")->attempt($credentials)) {
            $message = 'Đăng nhập thành công';
            $statusCode = Response::HTTP_UNAUTHORIZED;

            return $this->errorResponse($message, $statusCode);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('admin')->user(),
            'expires_in' => auth('admin')->factory()->getTTL(),
        ];
        $message = 'Get Token';
        $statusCode = Response::HTTP_OK;

        return $this->successResponse($data, $message, $statusCode);
    }

    /**
     * Get a JWT via given credentials.
     * @param App\Http\Requests\LoginUserRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login(LoginUserRequest $request)
    // {
    //     $credentials = request(['email', 'password']);

    //     if (!$token = auth("user")->setTTL(config('constant.user_token_expires'))->attempt($credentials)) {
    //         $message = 'メールアドレス、またはパスワードが異なります。';
    //         $statusCode = Response::HTTP_UNAUTHORIZED;

    //         return $this->errorResponse($message, $statusCode);
    //     }

    //     $login = $this->userService->handleLoginWithDeviceIdOrDeviceTokenNull($request);
    //     if (!$login) {
    //         auth('user')->logout();

    //         $message = 'Please check your device again.';
    //         $statusCode = Response::HTTP_BAD_REQUEST;

    //         return $this->errorResponse($message, $statusCode);
    //     }

    //     return $this->respondWithToken($token);
    // }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $userID = auth('user')->user()->id;
        $this->userService->removeDeviceToken($userID);
        auth('user')->logout();

        $data = null;
        $message = 'Successfully logged out';
        $statusCode = Response::HTTP_OK;

        return $this->successResponse($data, $message, $statusCode);
    }

}
