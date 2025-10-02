<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\RouteDiscovery\Attributes\Route;

class UserController extends Controller
{
    #[Route(method:'post')]
    public function login(LoginRequest $request)
    {
        return User::create($request->toArray());
    }
}
