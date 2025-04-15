@extends('layouts.login')

@section('title')
    Register
@endsection

@section('css')
@endsection

@section('content')
<div class="container login-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Register</h3>
            <x-errors.display-error />
            <form action="{{ route('register') }}" method="POST" class="row g-3">
                @csrf
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password Repeat</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

            <div class="text-center mt-3">
              <a href="{{ route('login') }}">Login</a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@section('js')
@endsection
