@extends('layouts.frontend')
@section('title', $title)
@section('content')
<div class="container">
    <div class="login-page-three-template">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-md-7 mb-3 mt-3">
                <div class="login-card-three">
                    <img src="{{ asset(config('settings.login_page_three_right_image') ?? 'backend/assets/loginpage/defaultrightimage.jpg') }}" alt="image">
                </div>
            </div>
            <div class="col-md-5 mb-3 mt-3">
                <div class="login-card-three">
                    <div class="card-body-three">
                        <div class="heading mb-1">
                            <h2 class="text-center">{{ config('settings.logintitle') ?? '' }}</h2>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="input-group">
                                        <span class="input-group-text" id="user-email"><i
                                                class="fa-solid fa-user"></i></span>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter Your Email" aria-label="user-email"
                                            aria-describedby="user-email">
                                    </div>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row mb-1">
                                    <div class="input-group">
                                        <span class="input-group-text" id="user-password"><i
                                                class="fa-solid fa-unlock-keyhole"></i></span>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Your Password" aria-label="user-password"
                                            aria-describedby="user-password">
                                    </div>
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <a class="create-account-three px-0" href="{{ route('user.register') }}">
                                            {{ __('Create Account') }}
                                        </a>
                                        <a class="forget-password-three px-0" href="{{ route('forgot.password') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="loginpagecommonbtn text-white btn w-100 fw-bold fs-2">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection