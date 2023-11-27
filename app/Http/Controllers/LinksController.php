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

    public function getAllocatedLinks() : JsonResponse
    {
            return response()->json([
                'data' => $this->LinksRepository->getAllocatedLinks()
            ]);
    }

    public function getNonAllocatedLinks() : JsonResponse
    {
            return response()->json([
                'data' => $this->LinksRepository->getNonAllocatedLinks()
            ]);
    }

    public function getLink($linkId) : JsonResponse
    {
            return response()->json([
                'data' => $this->LinksRepository->getLink($linkId)
            ]);
    }

    public function allocateLink(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinksRepository->allocateLink(
                $request->input('linkId'),
                $request->input('driverId'),
                $request->input('vehicleId')
            )
        ]);
    }
    public function createLink(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinksRepository->createLink(
                $request->input('lineId'),
                $request->input('departureDate')
            )
        ]);
    }

    public function updateLink(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinksRepository->updateLink(
                $request->input('linkId'),
                $request->input('lineId'),
                $request->input('departureDate')
            )
        ]);
    }

    public function deleteLink($linkId) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinksRepository->deleteLink($linkId)
        ]);
    }
}
