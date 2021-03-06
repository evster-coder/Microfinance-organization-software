<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'full_name' => 'required|string',
            'org_unit_id' => 'required',
            'roles' => 'required',
            'username' => 'required|string|min:4|max:20|unique:users,username,' . $this->id,
        ];
    }
}
