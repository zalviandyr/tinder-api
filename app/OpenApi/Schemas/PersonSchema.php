<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Person',
    required: ['id', 'name', 'picture', 'location', 'age', 'distance'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid', example: '11111111-1111-4111-8111-111111111111'),
        new OA\Property(property: 'name', type: 'string', example: 'Alex Summers'),
        new OA\Property(property: 'picture', type: 'string', format: 'uri', example: 'https://example.com/images/alex-summers.jpg'),
        new OA\Property(property: 'location', type: 'string', example: 'Jakarta'),
        new OA\Property(property: 'age', type: 'integer', format: 'int32', example: 27),
        new OA\Property(property: 'distance', type: 'integer', format: 'int32', example: 5),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ],
    type: 'object'
)]
class PersonSchema
{
}
