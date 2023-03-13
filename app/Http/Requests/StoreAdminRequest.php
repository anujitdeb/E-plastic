<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if(auth('admin')->user()->can('admin.create')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required',
            'email.required'    => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
}
