<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[OA\Post(
        path: '/api/user',
        operationId: 'users.store',
        summary: 'Register a user device',
        tags: ['Users'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UserCreateRequest')
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'User created',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(CreateRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json($user, 201);
    }
}
