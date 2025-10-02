<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'User',
    required: ['id', 'device_id'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid', example: '44444444-4444-4444-8444-444444444444'),
        new OA\Property(property: 'device_id', type: 'string', example: 'DEVICE-1234567890'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ],
    type: 'object'
)]
class UserSchema
{
}

#[OA\Schema(
    schema: 'UserCreateRequest',
    required: ['device_id'],
    properties: [
        new OA\Property(property: 'device_id', type: 'string', example: 'DEVICE-1234567890'),
    ],
    type: 'object'
)]
class UserCreateRequestSchema
{
}
