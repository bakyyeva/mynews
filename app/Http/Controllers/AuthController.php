<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }
        return view("auth.login");
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users,id'],
            'password' => ['required']
        ]);

        $remember = !is_null($request->remember) ? 1 : 0;
        $user = User::query()
            ->where('username', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $remember);

            session()->put('user', $user);

            return redirect()->route('admin.home');
        }
        return back()->withErrors([
            'user' => 'Username or password is incorrect',
            'password' => 'Username or password is incorrect'
        ]);
    }
    public function showRegister()
    {
        return view("auth.register");
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users,id'],
            'password' => ['required', 'confirmed']
        ]);

        $data = $request->except(['_token']);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'editor';

        try {
            $user = User::create($data);

            session()->put('user', $user);

            $editorRole = Role::query()
                ->where('name', 'editor')
                ->firstOrFail();

            $user->assignRole($editorRole);

            Auth::login($user);

            return redirect()->route('admin.home')->with('success', 'User created successfully!');

        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route("login");
        }
    }
}
