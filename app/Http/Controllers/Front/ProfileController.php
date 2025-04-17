<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile(Request $request, int $id)
    {
        $user = User::query()
            ->with('role')
            ->where('id', $id)
            ->firstOrFail();
        return view('front.profile.profile', compact('user'));
    }

    public function edit(Request $request, int $id)
    {
        $user = User::query()
            ->where('id', $id)
            ->firstOrFail();

        return view('front.profile.edit-profile', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::query()
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
        ]);

        $data = $request->except('_token');
        $user->update($data);

        return redirect()->back()->with('success', 'Your information updated successfully!');
    }

}
