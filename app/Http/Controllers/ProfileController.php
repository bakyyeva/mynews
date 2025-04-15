<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(Request $request, int $id)
    {
        $user = User::query()
            ->where('id', $id)
            ->firstOrFail();
        return view('admin.profile.profile', compact('user'));
    }

    public function edit(Request $request, int $id)
    {
        $user = User::query()
            ->where('id', $id)
            ->firstOrFail();
        return view('admin.profile.edit-profile', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::query()
            ->where('id', $id)
            ->firstOrFail();
        $data = $request->except('_token');
        $user->update($data);

        return redirect()->back()->with('success', 'Your information updated successfully!');
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed']
        ]);

        $user = User::query()
            ->where('id', $request->userID)
            ->firstOrFail();

        $currentPassword = $request->old_password;
        $newPassword = $request->password;

        if (!Hash::check($currentPassword, $user->password)) {
            return back()->withErrors(['Your current password is incorrect.']);
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route("login");
        }

        return redirect()->back()->with('success', 'Your password updated successfully!');
    }

}
