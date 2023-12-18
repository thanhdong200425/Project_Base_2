<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function getAll(): JsonResponse
    {
        $pets = Pet::all();
        if ($pets->count() <= 0) {
            return response()->json([
                'status' => false,
                'data' => 'No record found'
            ], 204);
        }

        return response()->json([
            'status' => true,
            'data' => $pets
        ], 200);
    }

    public function getOne(Request $request): JsonResponse
    {
        $pet = Pet::where('id', $request->id)->get();
        if ($pet->count() > 0):
            return response()->json([
                'status' => true,
                'data' => $pet
            ], 200);
        endif;

        return response()->json([
            'status' => false,
            'data' => 'Pet not found'
        ], 404);
    }
}
