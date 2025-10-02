<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Tinder API',
    description: 'API documentation for the Tinder-style matching service.'
)]
#[OA\Server(
    url: 'http://localhost',
    description: 'Local development server'
)]
#[OA\Tag(name: 'Persons', description: 'Operations related to people profiles')]
#[OA\Tag(name: 'Actions', description: 'Operations related to swipe actions')]
#[OA\Tag(name: 'Users', description: 'Operations related to application users')]
class OpenApiSpec
{
}
