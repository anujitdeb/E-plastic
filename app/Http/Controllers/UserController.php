<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /*View Registration Form*/
    public function registrationFromView(){
        return view('backend.auth.registration');
    }

    /*Storing Registration Information based on user type*/
    public function registrationPost(CreateUserRequest $request){

        $request->merge(['password' => Hash::make($request->input('password'))]);
        if($request->type == 'customer'){
            Customer::create($request->all());
        }
        elseif($request->type == 'buyer'){
            Buyer::create($request->all());
        }
        elseif($request->type == 'employee'){
            Employee::create($request->all());
        }
        else{
            return redirect()->back();
        }

        return redirect()->route('dashboard.login')->with('success', 'Registration done:)');

    }

}
