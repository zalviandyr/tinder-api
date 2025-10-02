<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Action\CreateRequest;
use App\Http\Requests\Action\DeleteRequest;
use App\Http\Requests\Action\IndexRequest;
use App\Models\Action;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use Spatie\RouteDiscovery\Attributes\Route;

class ActionController extends Controller
{
    #[OA\Get(
        path: '/api/action',
        operationId: 'actions.index',
        summary: 'List actions by device identifier',
        tags: ['Actions'],
        parameters: [
            new OA\Parameter(
                name: 'device_id',
                description: 'Device identifier associated with the user',
                in: 'query',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Actions retrieved',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Action')
                )
            ),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function index(IndexRequest $request): JsonResponse
    {
        $deviceId = $request->input('device_id');

        $actions = Action::query()
            ->whereHas('user', fn($query) => $query->where('device_id', $deviceId))
            ->get();

        return response()->json($actions);
    }

    #[OA\Post(
        path: '/api/action',
        operationId: 'actions.store',
        summary: 'Create or update an action',
        tags: ['Actions'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/ActionCreateRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Action stored',
                content: new OA\JsonContent(ref: '#/components/schemas/Action')
            ),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(CreateRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $action = Action::query()
            ->where('person_id', $payload['person_id'])
            ->where('user_id', $payload['user_id'])
            ->first();

        if ($action) {
            $action->status = $payload['status'];
            $action->save();
        } else {
            $action = Action::create($payload);
        }

        return response()->json($action);
    }

    #[Route(method: 'delete')]
    #[OA\Delete(
        path: '/api/action/destroy-by-person',
        operationId: 'actions.destroyByPerson',
        summary: 'Delete an action matching the provided user and person',
        tags: ['Actions'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/ActionDeleteRequest')
        ),
        responses: [
            new OA\Response(response: 204, description: 'Action deleted'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function destroyByPerson(DeleteRequest $request): Response
    {
        Action::query()
            ->where('person_id', $request->validated('person_id'))
            ->where('user_id', $request->validated('user_id'))
            ->delete();

        return response()->noContent();
    }
}
