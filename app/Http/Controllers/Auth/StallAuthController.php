<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StallAuthController extends Controller
{



   public function login(Request $request){
         $request->validate([
              'email'=>'required|email',
              'password'=>'required'
         ]);
         if (Auth::guard('stall')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
             return [
                    'status' => 'success',
                    'message' => 'Login Success',

                ];
            }else{
                return [
                    'status' => 'error',
                    'errors' => [
                        'password' => 'Invalid Credentials Check your email and password'
                    ],
                ];

         }

   }
    public function logout(){
            Auth::guard('stall')->logout();
            return redirect()->route('stall.login');
    }
    public function showLoginForm(){
            return view('auth.stall-login');
    }







    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
