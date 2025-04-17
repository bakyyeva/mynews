@extends('layouts.front')

@section('title')
    Detail Page
@endsection

@section('css')
@endsection

@section('content')
    <div class="card my-5">
        @if(!empty($new->image))
             <img src="{{ asset($new->image) }}" class="img-fluid">
        @else
            <img src="{{ asset('assets/test.jpeg') }}" class="img-fluid" style="max-height: 400px">
        @endif
        <div class="card-body">
        <h1 class="card-title">{{ $new->name }}</h1>
        <h4>{{ $new->author->username }}</h4>
        <hr class="my-2">
        <p class="card-text">{{ $new->description }}</p>
        <p class="text-end">{{ $new->format_created_at }}</p>
        </div>
    </div>
@endsection

@section('js')
@endsection
