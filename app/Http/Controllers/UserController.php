<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Traits\DeleteAjaxTrait;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use DeleteAjaxTrait;
    private $user;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

    }

    public function index()
    {
        $users = $this->user->paginate(10);
        return view('admin.user.index', compact('users'));

    }

    public function create()
    {
        $roles = $this->role->all();

        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $roleId = $request->role_id;
            $user->roles()->attach($roleId);

            DB::commit();

            return redirect()->route('admin.users.index');

        } catch (\Throwable $exception) {

            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }

    }

    public function edit(Request $request, $id)
    {
        $roles = $this->role->all();
        $user = $this->user->findOrFail($id);
        $rolesOfUser = $user->roles;

        return view('admin.user.edit', compact('roles', 'user', 'rolesOfUser'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user = $this->user->find($id);

            $user->roles()->sync($request->role_id);

            DB::commit();

            return redirect()->route('admin.users.index');
        } catch (\Throwable $exception) {

            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());

        }

    }

    public function delete($id)
    {
        return $this->deleteAjax($this->user, $id);
    }
}
