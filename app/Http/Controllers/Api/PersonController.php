<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class PersonController extends Controller
{
    #[OA\Get(
        path: '/api/person',
        operationId: 'persons.index',
        summary: 'List persons',
        tags: ['Persons'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Persons collection',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Person')
                )
            )
        ]
    )]
    public function index(): JsonResponse
    {
        return response()->json(Person::all());
    }
}
