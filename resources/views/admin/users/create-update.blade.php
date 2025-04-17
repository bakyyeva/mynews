@extends('layouts.admin')

@section('title')
    User {{ isset($user) ? 'Update' : 'Add' }}
@endsection

@section('css')
@endsection

@section('content')
    <x-bootstrap.card>
        <x-slot:header>
            User {{ isset($user) ? 'Update' : 'Add' }}
        </x-slot:header>
        <x-slot:body>
            <x-errors.display-error />
            <form action="{{ isset($user) ? route('user.edit', ['user' => $user->id]) : route('user.create') }}"
                  method="POST"
                  id="userForm">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-md-6 col-sm-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text"
                               class="form-control mb-3"
                               aria-label="default input example"
                               placeholder="Username"
                               name="username"
                               id="username"
                               required
                               value="{{ isset($user) ? $user->username : old('username') }}"
                        >
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control mb-3"
                               aria-label="default input example"
                               placeholder="Password"
                               name="password"
                               id="password"
                               value=""
                        >
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="role_id" class="form-label"></label>
                        <select
                            class="form-select form-control form-control-solid-bordered m-b-sm"
                            aria-label="Role"
                            name="role_id"
                            id="role_id"
                            required
                            >
                                <option value="{{ null }}">Choice Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ isset($user) && $user->role_id == $role->id ? 'selected' : ""}}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 col-sm-12 mt-4">
                        <button type="submit" class="mt-2 btn btn-success btn-rounded w-100" id="btnSave">
                            {{ isset($user) ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </div>
            </form>
        </x-slot:body>
    </x-bootstrap.card>

@endsection

@section('js')
@endsection


