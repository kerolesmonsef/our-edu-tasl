<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterUserRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(FilterUserRequest $request)
    {
        $users = $this->userService->filter($request);

        return response()->json([
            'status' => "success",
            'users' => UserResource::collection($users),
            "usersCount" => $users->count(),
        ]);
    }
}
