<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:students,email,' . $this->student->id,
            'password' => 'nullable|string|min:8|confirmed',
            'confirm_password' => 'nullable|string|min:8',
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
}
