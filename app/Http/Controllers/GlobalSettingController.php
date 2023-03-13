<?php

namespace App\Http\Controllers;

use App\Http\Requests\GlobalSettingRequest;
use App\Models\GlobalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GlobalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'Settings');

        if (auth('admin')->user()->can('setting.view')) {
            $global_setting = GlobalSetting::first();
            return view('backend.pages.setting.index', compact('global_setting'));
        } else {
            return redirect()->route('admin.dashboard');

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {


    }
    public function updateGlobal(GlobalSettingRequest $request)
    {
        $setting = GlobalSetting::first();
        if (!$setting) return ['message' => 'Setting Not Found', 'status' => false];
        $setting->update([
            'site_name' => $request->site_name,
            'site_title' => $request->site_title,
            'site_email' => $request->site_email,
            'site_phone' => $request->site_phone,
            'site_address' => $request->site_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'pinterest' => $request->pinterest,
        ]);
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/logo');
            $image->move($destinationPath, $name);
            $setting->logo = $name;
            $setting->save();
        }
        if($request->hasFile('favicon')){
            $image = $request->file('favicon');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/favicon');
            $image->move($destinationPath, $name);
            $setting->favicon = $name;
            $setting->save();
        }

        return ['message' => 'Setting updated successfully', 'status' => true, 'data' => $setting];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
