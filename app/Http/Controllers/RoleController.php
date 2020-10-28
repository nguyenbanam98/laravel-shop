<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteAjaxTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use DeleteAjaxTrait;
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index()
    {
        $roles = $this->role->paginate(5);

        return view('admin.role.index', compact('roles'));
    }
    public function create()
    {

        $permissionsParent = $this->permission->where('parent_id', 0)->get();

        return view('admin.role.add', compact('permissionsParent'));

    }

    public function store(Request $request)
    {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect()->route('admin.roles.index');

    }

    public function edit($id)
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $pemissionsChecked = $role->permissions;
        return view('admin.role.edit', compact('permissionsParent', 'role', 'pemissionsChecked'));
    }

    public function update(Request $request, $id)
    {
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.roles.index');
    }

    public function delete($id)
    {
        return $this->deleteAjax($this->role, $id);
    }

    public function createPermission()
    {
        return view('admin.permission.add');
    }

}
