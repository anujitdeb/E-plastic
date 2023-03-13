<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (!Admin::where('email', $value)->exists() && !Customer::where('email', $value)->exists()  && !Employee::where('email', $value)->exists()  && !Buyer::where('email', $value)->exists() ) {
                        $fail('The email must be unique and exist in either the users or another_table table.');
                    }
                },
            ],

//            'email' => 'required|email|exists:admins|exists:customers|exists:employees|exists:buyers',
            'password' => 'required',
            'type' => 'required|string'
        ];
    }
}
