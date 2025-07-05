<div class="container">
    <div class="row g-4 justify-content-center">
        <div class="col-md-4 mb-3 mt-3">
            <div class="login-card-two">
                <img src="{{ asset(config('settings.login_two_bg_image') ?? '') }}" alt="image">
                <div class="card-body-two">
                    <div class="heading heading-border mb-1">
                        <h2>{{ config('settings.logintitle') ?? '' }}</h2>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-email"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" aria-label="user-email" aria-describedby="user-email">
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-1">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-password"><i class="fa-solid fa-unlock-keyhole"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Your Password" aria-label="user-password" aria-describedby="user-password">
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <a class="create-account-two px-0" href="{{ route('user.register') }}">
                                        {{ __('Create Account') }}
                                    </a>
                                    <a class="forget-password-two px-0" href="{{ route('forgot.password') }}">
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
