<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\EMenu;
use App\Enums\ERouteName;
use App\Enums\ERole;
use App\Models\Menu;
use App\Models\RoleHasPermission;
use App\Models\User;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //

    public function index()
    {
        return view('admin.system.role.index');
    }
    public function create() {
        $menus = Menu::all();
        $permissions = Permission::all();
        $arrAction = ['index', 'edit', 'destroy', 'create', 'download'];
        $listNameMenu = EMenu::listNameMenu();
        $check = 1;
        return view('admin.system.role.create', compact('check', 'menus', 'permissions', 'arrAction', 'listNameMenu'));
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
                'status' => $request->status == ERole::STATUS_ON ? ERole::STATUS_ON : ERole::STATUS_OFF,
                // 'note' => $request->note,
            ]);
            $dataRoles = $request->role;
            $arrPer = [];

            if (!empty($dataRoles)) {
                foreach ($dataRoles as $key => $val) {
                    if ($val == 1) {
                        $arrPer[] = $key;
                    }
                }
            }
            // Save data table role_has_permissions
            if (!empty($arrPer)) {
                $role->givePermissionTo($arrPer);
            }

            DB::commit();

            return redirect()->route(ERouteName::ROUTE_ROLE_INDEX)->with('success',__("notification.common.success.add"));
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error',__("notification.common.fail.add"));
        }
    }

    public function edit($id) {
        $menus = Menu::all();
        $data = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $this->getRolePermissions($id);
        $arrAction = ['index', 'edit', 'destroy', 'create', 'download'];
        $listNameMenu = EMenu::listNameMenu();
        // $tab = null;
        $check = 2;

        return view(ERouteName::ROUTE_ROLE_EDIT, compact('check', 'data', 'permissions', 'rolePermissions', 'arrAction', 'menus', 'listNameMenu'));
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->status = $request->status == ERole::STATUS_ON ? ERole::STATUS_ON : ERole::STATUS_OFF;
            // $role->note = $request->note;
            $role->save();

            $dataRoles = $request->role;
            $arrPer = [];
            if (!empty($dataRoles)) {
                foreach ($dataRoles as $key => $val) {
                    if ($val == ERole::STATUS_ON) {
                        $arrPer[] = $key;
                    }
                }
            }
            $role->syncPermissions($arrPer);
            if ($request->status != ERole::STATUS_ON) {
                $this->updateModelHasRole($role->id, ['model_type' => ERole::STATUS_ON]);
            } else {
                $this->updateModelHasRole($role->id, ['model_type' => 'App\Models\User']);
            }
            DB::commit();
            return redirect()->route(ERouteName::ROUTE_ROLE_INDEX)->with('success',__("notification.common.success.update"));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error',__("notification.common.fail.update"));
        }
    }

    // public function listRoleUser($id) {
    //     $role = Role::findOrFail($id);
    //     if (empty($role)) {
    //         return redirect()->route(ERouteName::ROUTE_ROLE_INDEX);
    //     }
    //     return view('admin.system.role.list-role-user', compact('role'));
    // }

    // public function addRoleUser(Request $request, $idRole) {
    //     $dataRole = Role::findOrFail($idRole);
    //     if (empty($dataRole)) {
    //         return redirect()->route(ERouteName::ROUTE_ROLE_INDEX);
    //     }

    //     // Delete list role user

    //     // Add list role user
    //     $listId = $request->user? array_keys($request->user) : [];
    //     DB::table('model_has_roles')->where('role_id', $idRole)->whereNotIn("model_id",$listId)->delete();

    //         foreach ($listId as $userId) {
    //             $user = User::findOrFail($userId);
    //             $user->assignRole($idRole);
    //             if ($dataRole->status != ERole::STATUS_ON) {
    //                 $this->updateModelHasRole($idRole, ['model_type' => ERole::STATUS_ON]);
    //             }
    //         }

    //     return redirect()->route(ERouteName::ROUTE_ROLE_EDIT, $idRole)->with('success',__("notification.common.success.update"));
    // }

    function getRolePermissions ($idRole) {
        $rolePermissions = RoleHasPermission::where("role_has_permissions.role_id", $idRole)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $dataPermission = [];
        foreach ($rolePermissions as $permission) {
            $dataPermission[] = $permission;
        }

        return $dataPermission;
    }

    function updateModelHasRole($roleId, $dataUpdate)
    {
        $data = DB::table('model_has_roles')->where('role_id', $roleId)->get();
        if ($data->isNotEmpty()) {
            DB::table('model_has_roles')->where('role_id', $roleId)
                ->update($dataUpdate);
        }
    }
}
