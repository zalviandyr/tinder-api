<?php

namespace App\Http\Requests\Action;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'device_id' => 'required|exists:users,device_id'
        ];
    }
}
