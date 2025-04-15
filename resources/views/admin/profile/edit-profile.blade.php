@extends('layouts.admin')

@section('title')
    Edit Profile
@endsection

@section('css')
@endsection

@section('content')
    <x-bootstrap.card>
        <x-slot:header>
            Edit Profile
        </x-slot:header>
        <x-slot:body>
            <form action="{{ route('profile.edit', ['id' => $user->id]) }}" method="POST">
                @csrf
                <h5 class="mb-0 mt-4">Your Information</h5>
                <hr>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                    </div>
                </div>
                <div class="text-start mt-3">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </form>
        </x-slot:body>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot:header>
            <h5 class="mt-4">Reset Password</h5>
        </x-slot:header>
        <x-slot:body>
            <x-errors.display-error />
            <form action="{{ route('password-change') }}" method="POST">
                @csrf
                <div class="g-3">
                    <div class="">
                        <input type="hidden" name="userID" value="{{ $user->id }}">
                        <label class="form-label">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" id="password"  class="form-control">
                    </div>
                    <div class="mt-2">
                        <label class="form-label">Repeat Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="text-start mt-3">
                    <button type="submit" id="btnChangePassword" class="btn btn-primary px-4">Reset Password</button>
                </div>
            </form>
        </x-slot:body>
    </x-bootstrap.card>

@endsection

@section('js')
@endsection
