<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Repositories\LinksRepository;

class LinksController extends Controller
{
    private LinksRepository $LinksRepository;

    public function __construct(LinksRepository $LinksRepository)
    {
        $this->LinksRepository = $LinksRepository;
    }

    public function getLinks() : JsonResponse
    {
            return response()->json([
                'data' => $this->LinksRepository->getLinks()
            ]);
    }

    public function getNonAllocatedLinks() : JsonResponse
    {
            return response()->json([
                'data' => $this->LinksRepository->getNonAllocatedLinks()
            ]);
    }
}
