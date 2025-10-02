<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Action\CreateRequest;
use App\Http\Requests\Action\DeleteRequest;
use App\Http\Requests\Action\IndexRequest;
use App\Models\Action;
use Illuminate\Http\Request;
use Spatie\RouteDiscovery\Attributes\Route;

class ActionController extends Controller
{
    public function index(IndexRequest $request)
    {
        $deviceId = $request->device_id;

        return Action::query()
            ->whereHas('user', fn($q) => $q->where('device_id', $deviceId))
            ->get();
    }

    public function store(CreateRequest $request)
    {
        $action = Action::query()
            ->where('person_id', $request->person_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($action) {
            $action->status = $request->status;
            $action->save();
        } else {
            $action = Action::create($request->toArray());
        }

        return $action;
    }

    #[Route(method: 'delete')]
    public function destroyByPerson(DeleteRequest $request)
    {
        Action::query()
            ->where('person_id', $request->person_id)
            ->where('user_id', $request->user_id)
            ->delete();
    }
}
