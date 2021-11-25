<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DataTables,Auth,DB;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the roles page
     *
     */
    public function index($roleId)
    {
        try{
            
            $permissions  = Permission::get()->pluck('name','id');
            $data = $this->getAllAssignPermission($roleId);

            return view('permission.index', compact('permissions','data','roleId'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);

        }
    }

    public function getAllAssignPermission($roleId){
        $getData = DB::table('role_has_permissions')
                   ->where('role_id', $roleId)
                   ->get();
        $newData = array();           
        if(!empty($getData)) {
            foreach($getData as $value){
                $permissionId =  $value->permission_id;
                $newData[$permissionId] = $value->permission_id;
                
            }
        } 

        return $newData;      
    }

    


    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'permission' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{
            $roleId = $request->roleId;
            $permission = Permission::create(['name' => $request->permission]);
            //$permission->syncRoles($request->roles);

            if($permission){ 
                return redirect('permission/'.$roleId)->with('success', 'Permission created succesfully!');
            }else{
                return redirect('permission/'.$roleId)->with('error', 'Failed to create permission! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

  

    public function update(Request $request)
    {

        try{

            $postData = $request->all();
            $roleId = $postData['roleId'];

            if(!empty($postData['lists'])){

            $delete = DB::table('role_has_permissions')->where('role_id', $roleId)->delete();


            foreach ($postData['lists'] as $key => $value) {

                $permissionId = $key;
                $updateData = array(
                'permission_id' => $permissionId,
                'role_id' => $roleId,
                );

                DB::table('role_has_permissions')->insert($updateData);   

            }
                return redirect('permission/'.$roleId)->with('success',  __('Permission has updated successfully'));
            }else{
                return redirect('permission/'.$roleId)->with('error',  __('Permission not update due to some technical problem!'));
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    public function delete($id)
    {
        $permission   = Permission::find($id);
        if($permission){
            $delete = $permission->delete();
            $perm   = $permission->roles()->delete();

            return redirect('permission')->with('success', 'Permission deleted!');
        }else{
            return redirect('404');
        }
    }


    public function getPermissionBadgeByRole(Request $request){
        $badges = '';
        if ($request->id) {
            $role = Role::find($request->id);
            $permissions =  $role->permissions()->pluck('name','id');
            foreach ($permissions as $key => $permission) {
                $badges .= '<span class="badge badge-dark m-1">'.$permission.'</span>';
            }
        }

        if($role->name == 'Super Admin'){
            $badges = 'Super Admin has all the permissions!';
        }

        return $badges;
    }
}
