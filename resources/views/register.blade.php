@extends('layout')
@section('title','Register')
@section('content')
<link href="{{ asset('/css/register.css') }}" rel="stylesheet">
<form action="{{ route('registration.post') }}" method='POST'>
@csrf
    <section class="sign_up">
        <div class="container">
            <h1>Register</h1>
            <p id="create">Create your account. It's free and only takes a minute</p>
            <div class="name">
                <input type="text" name="userName" placeholder="Name" required>
            </div>
            <div class="details">
                <input type="email"  name="userEmail" placeholder="Email" required>
                <input type="password" name="userPassword" placeholder="Password" required>
            </div>
            <div class="checkbox">
                <input type="checkbox" class="check" required>
                <p class="check">I accept the <span class="term"><a href="#">Terms of use</a></span> & <span><a id="privacy" href="#">Privacy Policy</a></span></p>
            </div>
            <button type="submit" id="register_btn">Register Now</button>
        </div>
        <div class="signIn">
            <p>Already have an account? <span><a href="#">Sign in</a></span></p>
        </div>
    </section>
</form>

@endsection