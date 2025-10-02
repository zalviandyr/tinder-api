<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'device_id' => 'required|string|unique:users,device_id,'.$this->id.',device_id'
        ];
    }
}
