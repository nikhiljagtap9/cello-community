@extends('layouts.main')

@section('content')

<div class="clear"></div>
<br><br> 
<div class="clear"></div>
<style type="text/css">
   .footer-dark.main-footer .container.pt-4{
   display: none;
   }
   .custom-navbar.navbar{
   display: none;
   }
   body{
   background:#f7f7f7;
   }
</style>
<link rel="stylesheet" href="assets/css/internal_page.css">
<div class="p-3 p-sm-5">
   <div class="row g-4 g-xl-5 justify-content-between login_page_cs">
      <div class="col-xl-6 d-none d-xl-block">
         <img src="../assets/images/login_back.png" class="login_left" >
      </div>
      <div class="col-xl-6 d-flex justify-content-center">
         <div class="authentication-wrap overflow-hidden position-relative text-center text-sm-start my-5">
            <!-- Start Header Text -->
            <div class="mb-5">
               <!-- <h2 class="display-6 fw-semibold mb-3">Welcome back!</h2> -->
               <p class="mb-0 cont_tx">
                  Please Sign in to Continue.
               </p>
            </div>
            <!-- /.End Divider -->
            <form class="register-form" action="{{ route('admin.login.post') }}" method="POST">
               @csrf
                <!-- Start Form Group -->
               <div class="form-group mb-4">
                    <label class="required">Enter Email</label>
                    <input type="email" name="email" id="email"  class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback text-start">{{ $message }}</div>
                    @enderror
               </div>
               <!-- /.End Form Group -->
               <!-- Start Form Group -->
               <div class="form-group mb-4">
                    <label class="required">Password</label>
                    <input type="password" name="password" id="password" class="form-control password @error('password') is-invalid @enderror" autocomplete="off">
                    <i data-bs-toggle="#password" class="fa-regular fa-eye-slash toggle-password"></i>
                    @error('password')
                        <div class="invalid-feedback text-start">{{ $message }}</div>
                    @enderror
               </div>
               <!-- /.End Form Group -->
               <!-- Start Checkbox -->
               <div class="form-check mb-4 text-start">
                  <input class="form-check-input" type="checkbox"  name="remember" id="remember">
                  <label class="form-check-label" for="flexCheckDefault">Remember me next time</label>
               </div>
               <!-- /.End Checkbox -->
               <!-- Start Button -->
               <button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button>
               <!-- End Button -->
            </form>
            <!-- Start Bottom Text -->
            <!-- <div class="bottom-text text-center mt-4"> Don't have an account? <a href="{{route('register')}}" class="fw-medium text-decoration-underline">Register Now</a>
            </div> -->
            <!-- /.End Bottom Text -->
            <div class="clear"></div>
         </div>
      </div>
   </div>
   <div class="clear"></div>
</div>
<div class="clear"></div>

@endsection
