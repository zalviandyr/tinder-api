<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Action',
    required: ['id', 'person_id', 'user_id', 'status'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid', example: '55555555-5555-4555-8555-555555555555'),
        new OA\Property(property: 'person_id', type: 'string', format: 'uuid', example: '11111111-1111-4111-8111-111111111111'),
        new OA\Property(property: 'user_id', type: 'string', format: 'uuid', example: '44444444-4444-4444-8444-444444444444'),
        new OA\Property(property: 'status', type: 'string', enum: ['LIKE', 'DISLIKE'], example: 'LIKE'),
        new OA\Property(property: 'person', ref: '#/components/schemas/Person'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ],
    type: 'object'
)]
class ActionSchema
{
}

#[OA\Schema(
    schema: 'ActionCreateRequest',
    required: ['person_id', 'user_id', 'status'],
    properties: [
        new OA\Property(property: 'person_id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'user_id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'status', type: 'string', enum: ['LIKE', 'DISLIKE']),
    ],
    type: 'object'
)]
class ActionCreateRequestSchema
{
}

#[OA\Schema(
    schema: 'ActionDeleteRequest',
    required: ['person_id', 'user_id'],
    properties: [
        new OA\Property(property: 'person_id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'user_id', type: 'string', format: 'uuid'),
    ],
    type: 'object'
)]
class ActionDeleteRequestSchema
{
}
