<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
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
     * @return array
     */
    public function list(): array
    {
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.view')) abort(403, 'Unauthorized Access!');
        $roles = Role::all();
       $view = view('backend.pages.role.list', compact('roles'));
       return ['html' => $view->render(),'status' => 200];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        Session::put('page', 'Roles');
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.view')) abort(403, 'Unauthorized Access!');
        $roles = Role::all();
        return view('backend.pages.role.index', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request)
    {
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.create')) abort(403, 'Unauthorized Access!');
        $this->validate($request, [
            'name' => 'required|unique:roles|max:10',
            'permissions' => 'required',
            'guard_name' => 'required|in:admin,web',
        ]);
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name, 'guard_name' => $request->guard_name]);
            $role->syncPermissions($request->permissions);
            DB::commit();
            return ['message' => 'Role created successfully', 'status' => 200];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'status' => 500];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.create')) abort(403, 'Unauthorized Access!');
        $permissions = Permission::all();
        $view = view('backend.pages.role.create', compact('permissions'))->render();
        return ['data' => $view, 'status' => 'success'];

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
     * @return array
     */
    public function edit($id)
    {
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.edit')) abort(403, 'Unauthorized Access!');
        $role = Role::find($id);

        $permissions = Permission::all();
        $permissions_with_same_guard = array();
        foreach ($permissions as $item2) {
            if ($item2->guard_name == $role->guard_name) {
                array_push($permissions_with_same_guard, $item2);
            }
        }
        $permissions = $permissions_with_same_guard;
        $view = view('backend.pages.role.create', compact('role', 'permissions'))->render();
        return ['data' => $view, 'status' => 'success'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return string[]
     */
    public function update(Request $request, $id)
    {
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.edit')) abort(403, 'Unauthorized Access!');
        $this->validate($request, [
            'name' => 'required|max:30',
            'permissions' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permissions);
            DB::commit();
            return ['message' => 'Role Updated Successfully', 'status' => 'success'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => 'Something went wrong', 'status' => 'error'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string[]
     */
    public function destroy($id)
    {
        //Check and guard the permission
        if (is_null($this->admin) || !$this->admin->can('role.delete')) abort(403, 'Unauthorized Access!');
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            if($role->name == 'superadmin'){
                return ['message' => 'Super Admin Role can not be deleted', 'status' => 'error'];
            }

            $role->delete();
            DB::commit();
            return ['message' => 'Role Deleted Successfully', 'status' => 'success'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => 'Something went wrong', 'status' => 'error'];
        }
    }
}
