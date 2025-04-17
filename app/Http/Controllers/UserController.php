<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    public function create()
    {
        $roles = Role::query()
            ->whereNot('name', 'admin')
            ->get();
        return view('admin.users.create-update', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users,username'],
            'password' => ['required'],
            'role_id' => ['required'],
        ]);

        $data = $request->except('_token');
        $data['password'] = bcrypt($data["password"]);

        $role = Role::query()
            ->where('id', $request->role_id)
            ->firstOrFail();

        try {
            $user = User::create($data);
            $user->syncRoles($role);
        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }
        return redirect()->route('user.list');
    }

    public function edit(Request $request, User $user)
    {
        $roles = Role::query()
            ->whereNot('name', 'admin')
            ->get();

        return view('admin.users.create-update', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'role_id' => ['required'],
        ]);

        $data = $request->except("_token");

        if (!is_null($data['password'])) {
            $data['password'] = bcrypt($data["password"]);
        } else {
            unset($data["password"]);
        }

        try {
            $user->update($data);
        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }
        return redirect()->route('user.list');
    }

    public function delete(Request $request)
    {
        $user = User::query()
            ->where('id', $request->id)
            ->firstOrFail();

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Success'
        ])->setStatusCode(200);
    }
}
