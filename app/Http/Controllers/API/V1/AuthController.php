<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\User\UserServiceInterface;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * @var $userService
     */
    protected $userService;

    public function __construct(
        UserServiceInterface $userService
    ) {
        $this->userService= $userService;
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

        $data = [];
        $message = 'Successfully register';
        $statusCode = Response::HTTP_OK;

        return $this->successResponse($data, $message, $statusCode);
    }
}
