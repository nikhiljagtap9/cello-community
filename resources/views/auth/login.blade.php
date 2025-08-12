@extends('layouts.app') {{-- or your custom layout --}}
   <style>
     .pc-sidebar, .pc-header, .pc-footer{
      display: none !important;
     }

     .logo_main_login{
      width: 300px;
      margin-bottom: 20px;
     }
   </style>
@section('content')
<div class="auth-main v1">
    <div class="auth-wrapper">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('admin/assets/images/Logo.png') }}" alt="images" class="img-fluid mb-3 logo_main_login" />
                        <h4 class="f-w-500 mb-1">Login with your email</h4>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-control" placeholder="Email Address" />
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" required
                                class="form-control" placeholder="Password" />
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex mt-1 justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" name="remember" id="customCheckc1" />
                                <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    <h6 class="f-w-400 mb-0">Forgot Password?</h6>
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
