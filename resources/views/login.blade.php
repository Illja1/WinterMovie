@extends('layout')
@section('title', 'Login')
@section('content')
  <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
<div class="login-wrapper">
  <div class="inner-wrapper text-center">
    <h2 class="login-title">Login to your account</h2>
    <form action="{{ route('login.post') }}" method="POST" id="formvalidate">
      @csrf
      <div class="input-group">
        <label class="input-label" for="email">Email</label>
        <input class="form-control" name="email" id="email" type="text" placeholder="" />
        <span class="input-highlight"></span>
      </div>
      <div class="input-group">
        <label class="input-label" for="userPassword">Password</label>
        <input class="form-control" name="userPassword" id="userPassword" type="password" placeholder="" />
        <span class="input-highlight"></span>
      </div>

      <button type="submit" id="login">Login</button>
      <div class="clearfix supporter">
        <div class="pull-left remember-me">
        </div>
        <a class="forgot pull-right" href="#">Forgot Password?</a>
      </div>
    </form>
  </div>
  <div class="signup-wrapper text-center">
    <a href="{{route('registration')}}">Don't have an account? <span class="text-primary">Create One</span></a>
  </div>
</div>
@endsection
