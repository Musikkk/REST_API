<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\People;

class PeopleController extends Controller
{
    public function index(): JsonResponse
    {   try {
            return response()->json(People::all(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $person = People::find($id);

            if ($person) {
                return response()->json($person, Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Person not found'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {   
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255'
        ]);

        $person = People::find($id);

        try {
            if ($person) {
                $person->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone_number' => $request->input('phone_number'),
                    'street' => $request->input('street'),
                    'city' => $request->input('city'),
                    'country' => $request->input('country')
                ]);

                return response()->json(['message' => 'Person updated successfully'], JsonResponse::HTTP_OK);
            } else {
                return response()->json(['message' => 'Person not found'], JsonResponse::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        $person = People::find($id);

        try {
            if ($person) {
                $person->delete();
                return response()->json(['message' => 'Person deleted successfully'], JsonResponse::HTTP_OK);
            } else {
                return response()->json(['message' => 'Person not found'], JsonResponse::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255'
        ]);

        try {
            $person = People::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'country' => $request->input('country')
            ]);

            return response()->json(['message' => 'Person created successfully'], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
