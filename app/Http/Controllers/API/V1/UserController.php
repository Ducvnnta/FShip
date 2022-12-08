<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationRequest;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
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
     * Display a listing of the resource.
     * @param  App\Http\Requests\PaginateRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function getListAdminUser(PaginationRequest $request)
    {
        $perPage       = $request->per_page;
        $page          = $request->page;
        $result = $this->userService->getListAdminUser($perPage, $page);
        $message = trans('Danh sách khác hàng');
        $statusCode = Response::HTTP_OK;

        return $this->successResponse($result, $message, $statusCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(User $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(User $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $post)
    {

    }
}
