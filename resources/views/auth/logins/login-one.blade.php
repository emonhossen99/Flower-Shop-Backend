<div class="container">
    <div class="row g-4 justify-content-center">
        <div class="col-md-6 mb-3 mt-3">
            <div class="login-page-one">
                <div class="heading heading-border mb-1 frontend-product-title text-center">
                    <h2 class="title ps-2 ">{{ config('settings.logintitle') ?? '' }}</h2>
                </div>
                <div>
                    <div class="card-body px-0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <label
                                    for="email"class="col-md-4 col-form-label required">{{ __('Email Address :') }}</label>
                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Enter Your Email">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label for="password"
                                    class="col-md-4 col-form-label required">{{ __('Password :') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Enter Your Password">
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="forget-password px-0" href="{{ route('user.register') }}">
                                        {{ __('Create Account') }}
                                    </a>
                                    <a class="btn forget-password px-0" href="{{ route('forgot.password') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="loginpagecommonbtn text-white btn w-100 fw-bold fs-2">
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
