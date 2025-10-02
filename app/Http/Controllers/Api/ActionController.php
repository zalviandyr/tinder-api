<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActionRequest;
use App\Models\Action;

class ActionController extends Controller
{
    public function index()
    {
        //
    }

    public function store(CreateActionRequest $request)
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

    public function destroy(Action $action)
    {
        $action?->delete();
    }
}
