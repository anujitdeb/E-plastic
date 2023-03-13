<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public $admin;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Session::put('page', 'Profile');
        $user = Admin::find(auth()->guard('admin')->user()->id);
        return view('backend.pages.profile.index', ['user' => $user]);

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
        if (auth()->guard('admin')->user()->id == $id) {
            $user = Admin::find($id);
            $compact = compact('user');
            $view = view('backend.pages.profile.edit', $compact);
            return ['data' => $view->render(), 'status' => 'success'];

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string[]
     */
    public function update(AdminProfileUpdateRequest $request, $id)
    {

        if (auth()->guard('admin')->user()->id == $id) {
            $user = Admin::findOrfail($id);
            $validated = $request->validated();
            $user->update($validated);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admins'), $imageName);
                $user->image = $imageName;
            }

            $user->save();

            return ['status' => 'success', 'message' => 'Profile Updated Successfully'];
        }
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

    /**
     * @return Application|Factory|View
     */
    public function changePassword()
    {

        return view('backend.pages.profile.change-password');
    }

    public function changePasswordPost(Request $request)
    {

        $hashedPassword = auth()->guard('admin')->user()->password;

        if (Hash::check($request->current_password, $hashedPassword)) {
            if (!Hash::check($request->new_password, $hashedPassword)) {
                $user = Admin::find(auth()->guard('admin')->user()->id);
                $user->password = Hash::make($request->new_password);
                $user->save();
                return response()->json(['status' => 'success', 'message' => 'Password Changed Successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'New Password cannot be same as your current password. Please choose a different password.']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Current Password does not match.']);
        }
    }
}
