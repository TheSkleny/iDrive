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
    public function getUsers() : JsonResponse
    {
            return response()->json([
                'data' => $this->UserRepository->getUsers()
            ]);
    }
    // Možná stačí jen registrace
    public function addUser(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->UserRepository->addUser(
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $request->input('typeId')
            )
        ]);
    }
    public function updateUserInfo(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->UserRepository->updateUserInfo(
                $request->input('userId'),
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $request->input('typeId')
            )
        ]);
    }
    public function deleteUser($userId) : JsonResponse
    {
        return response()->json([
            'data' => $this->UserRepository->deleteUser($userId)
        ]);
    }
}
