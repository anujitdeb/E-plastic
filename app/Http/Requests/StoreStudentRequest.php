<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:8|confirmed',
            'confirm_password' => 'required|string|min:8',
            'phone' => 'required|string|max:255',
            'batch' => 'required|integer',
            'type' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'roll' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'nullable|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone is required',
            'batch.required' => 'Batch is required',
            'type.required' => 'Type is required',
            'department.required' => 'Department is required',
            'semester.required' => 'Semester is required',
            'roll.required' => 'Roll is required',
            'image.required' => 'Image is required',
            'status.required' => 'Status is required',
            'name.string' => 'Name must be a string',
            'email.string' => 'Email must be a string',
            'password.string' => 'Password must be a string',
            'phone.string' => 'Phone must be a string',
            'type.string' => 'Type must be a string',
            'department.string' => 'Department must be a string',
            'semester.string' => 'Semester must be a string',
            'name.max' => 'Name must be less than 255 characters',
            'email.max' => 'Email must be less than 255 characters',
            'password.min' => 'Password must be at least 8 characters',
            'phone.max' => 'Phone must be less than 255 characters',
            'type.max' => 'Type must be less than 255 characters',
            'department.max' => 'Department must be less than 255 characters',
            'semester.max' => 'Semester must be less than 255 characters',
            'email.unique' => 'Email must be unique',
            'password.confirmed' => 'Password must be confirmed',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
            'image.max' => 'Image must be less than 2048 kilobytes',
            'batch.integer' => 'Batch must be an integer',
            'roll.integer' => 'Roll must be an integer',
            'status.boolean' => 'Status must be a boolean',
            'confirm_password.required' => 'Confirm Password is required',
            'confirm_password.string' => 'Confirm Password must be a string',
            'confirm_password.min' => 'Confirm Password must be at least 8 characters',

        ];
    }
}
