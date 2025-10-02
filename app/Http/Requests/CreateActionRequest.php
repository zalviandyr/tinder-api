<?php

namespace App\Http\Requests;

use App\ActionStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\In;

class CreateActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'person_id' => 'required|exists:persons,id',
            'user_id' => 'required|exists:users,id',
            'status' => ['required', new In(ActionStatus::cases(), fn($e) => $e->name)]
        ];
    }
}
