<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function getUsersByType($typeId) : JsonResponse
    {
            return response()->json([
                'data' => $this->UserRepository->getUsersByType($typeId)
            ]);
    }
}
