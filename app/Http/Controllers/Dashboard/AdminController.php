<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public $admin;

    public function __construct()
   {
        $this->middleware(function ($request, $next) {
           $this->admin = Auth::guard('admin')->user();
           return $next($request);
       });
   }


    public function index()
    {
        Session::put('page', 'Admins');
        /* if($this->admin->can('admin.dashboard')){*/

        $admins= Cache::rememberForever('admins', function () {
            return Admin::with('roles')->get();
        });
        $compact = compact('admins');
        return view('backend.pages.admin.index', $compact);
        /* }*/
//        return response()->json($admins , 200);
    }


    public function create()
    {
        if (is_null($this->admin) || !$this->admin->can('admin.create')) abort(403, 'Unauthorized Access!');
        $roles = Role::where('guard_name', 'admin')->get();
        $compact = compact('roles');
        $view = view('backend.pages.admin.create', $compact);
        return ['data' => $view->render(), 'status' => 'success'];

    }

    public function store(StoreAdminRequest $request)
    {
        if (is_null($this->admin) || !$this->admin->can('admin.create')) abort(403, 'Unauthorized Access!');
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'username' => 'required|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->save();
        $admin->assignRole($request->role);
        return ['status' => 'success', 'message' => 'Admin Created Successfully'];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (is_null($this->admin) || !$this->admin->can('admin.edit')) abort(403, 'Unauthorized Access!');
        $admin = Admin::find($id);
        if (!$admin) return ['status' => 'error', 'message' => 'Admin Not Found'];
        $roles = Role::where('guard_name', 'admin')->get();
        $compact = compact('admin', 'roles');
        $view = view('backend.pages.admin.create', $compact);
        return ['data' => $view->render(), 'status' => 'success'];
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        if (is_null($this->admin) || !$this->admin->can('admin.edit')) abort(403, 'Unauthorized Access!');
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $id,
            'username' => 'required|unique:admins,username,' . $id,
            'role' => 'required',
        ]);
//        dd($request->all());
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->save();
        $admin->syncRoles($request->role);
        return  ['status' => 'success', 'message' => 'Admin Updated Successfully'];
    }

    public function destroy($id)
    {
        if (is_null($this->admin) || !$this->admin->can('admin.delete')) abort(403, 'Unauthorized Access!');
        $admin = Admin::find($id);
        if ($this->admin->id == $admin->id) return ['status' => 'error', 'message' => 'You Can Not Delete Your Own Account'];
        if (!$admin) return ['status' => 'error', 'message' => 'Admin Not Found'];
        $admin->delete();
        return ['status' => 'success', 'message' => 'Admin Deleted Successfully'];
    }

    public function list(): array
    {
        if (is_null($this->admin) || !$this->admin->can('admin.view')) abort(403, 'Unauthorized Access!');
        $admins = Admin::all();
        $compact = compact('admins');
        $view = view('backend.pages.admin.list', $compact);
        return ['html' => $view->render(), 'status' => 'success'];
    }


    public function showLoginForm()
    {
        return view('backend.auth.login');
    }


    public function login(LoginRequest $request): array
    {
//        return $request->all();
        $credentials = $request->only('email', 'password');
        if($request->type == 'admin'){
            if (Auth::guard('admin')->attempt($credentials)) {
                return ['status' => 'success', 'message' => 'Login Success'];
            }
        }
        elseif($request->type == 'customer'){

            if (Auth::guard('customer')->attempt($credentials)) {
//                return $request->all();
                return ['status' => 'success', 'message' => 'Login Success'];
            }
        }
        elseif($request->type == 'employee'){
            if (Auth::guard('employee')->attempt($credentials)) {
                return ['status' => 'success', 'message' => 'Login Success'];
            }
        }
        elseif($request->type == 'buyer'){
            if (Auth::guard('buyer')->attempt($credentials)) {
                return ['status' => 'success', 'message' => 'Login Success'];
            }
        }

        return ['status' => 'error', 'errors' => ['password' => ['These credentials do not match our records.']]];
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('dashboard.index');
    }

    public function forgotPassword()
    {
        //dd('forgot password');
        return view('backend.auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
//check if email exists in admins table
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with('error' , 'error Email Not Found');
        }


        $token = Str::random(6);
        $user =DB::table('password_resets')->UpdateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );


        $link = route('dashboard.Reset_password', $token);
        $data['link'] =   $link;
        $data['email'] = $request->email;

//send mail


        Mail::send('backend.auth.mail', $data, function ($message) use ($data) {
            $message->from('thanvisub47@gmail.com', 'Thanvi');
            $message->to($data['email']);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'A password reset link has been sent to your email.');

    }





    public function resetPasswordForm($token)

    {      $tokenData = DB::table('password_resets')
        ->where('token',$token)->first();
//        dd($tokenData , $token);
        if (!$tokenData) return redirect()->route('dashboard.index');
        else{
            $admin= Admin::where('email', $tokenData->email)->first();
            return view('backend.auth.Reset_password', compact('admin'));
        }


    }






    public function resetPasswordUpdate(Request $request)
    {
//        dd($request->all());
        $request->validate([

            'password' => 'required|confirmed',
        ]);
        $id = $request->id;
        $admin=Admin::find($id);
//      dd($admin);
        $admin->password=bcrypt($request->password);
        $admin->save();
        DB::table('password_resets')->where('email', $request->email)->delete();
        return redirect()->route('dashboard.index')->with('success', 'Password Changed Successfully');

    }



}
