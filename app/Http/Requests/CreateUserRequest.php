<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'phone'     => 'required|string|max:255|unique:customers|unique:buyers|unique:employees',
            'email'    => 'required|string|email|max:255|unique:customers|unique:buyers|unique:employees',
            'type'    => 'required|string',
            'address'    => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'cpassword' => 'same:password',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required',
            'phone.required'     => 'Phone is required',
            'type.required'     => 'Type is required',
            'address.required'     => 'Address is required',
            'email.required'    => 'Email is required',
            'password.required' => 'Password is required',
            'cpassword.required' => 'Confirm password must be same as Password',
            'image.nullable' => 'Image type or size is not valid'
        ];
    }
}
