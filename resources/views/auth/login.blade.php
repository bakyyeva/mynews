@extends('layouts.login')

@section('title')
    Login Page
@endsection

@section('css')
@endsection

@section('content')
<div class="container login-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            <x-errors.display-error />
            <form action="{{ route('login') }}" method="POST">
                @csrf
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                  Remember me
                </label>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

            <div class="text-center mt-3">
              <a href="{{ route('register') }}">Register</a>
            </div>

          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@section('js')
@endsection
