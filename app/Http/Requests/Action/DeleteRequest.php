<?php

namespace App\Http\Requests\Action;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'person_id' => 'required|exists:persons,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
