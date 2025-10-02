<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(CreateRequest $request)
    {
        return User::create($request->toArray());
    }
}
