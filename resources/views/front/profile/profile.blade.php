
@extends('layouts.front')

@section('title')
    Profile
@endsection

@section('css')
@endsection

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <div class="mt-5 d-flex align-items-start justify-content-between">
                <div class="">
                    <h3 class="mb-2">{{ $user->username }} </h3>
                    <p class="mb-1">{{ $user->role->name }}</p>
                </div>
                <div class="">
                    <a href="{{ route('front.profile.edit', ['id' => $user->id ])}}" class="btn btn-primary">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
