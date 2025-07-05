<div class="container">
    <div class="row g-4 justify-content-center">
        <div class="col-md-6 mb-3 mt-3">
            <div class="login-page-one">
                <div class="heading heading-border mb-1 frontend-product-title text-center">
                    <h2 class="title ps-2 ">{{ config('settings.registerpagefirsttitle') ?? '' }}</h2>
                </div>
                <form method="POST" action="{{ route('user.register.store') }}">
                    @csrf
                    <div class="row">
                        <label for="name" class="col-md-4 col-form-label required">{{ __('First Name : ') }}</label>
                        <div class="col-md-8">
                            <input id="name" type="text"
                                class="form-control @error('fname') is-invalid @enderror" name="fname"
                                value="{{ old('fname') }}" required autocomplete="fname" autofocus
                                placeholder="Enter Your First Name...">
                            @error('fname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label for="name" class="col-md-4 col-form-label required">{{ __('Last Name : ') }}</label>
                        <div class="col-md-8">
                            <input id="name" type="text"
                                class="form-control @error('lname') is-invalid @enderror" name="lname"
                                value="{{ old('lname') }}" required autocomplete="lname" autofocus
                                placeholder="Enter Your Last Name...">
                            @error('lname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <label for="email"
                            class="col-md-4 col-form-label required">{{ __('Email Address : ') }}</label>
                        <div class="col-md-8">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Enter Your Email Address...">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label for="phone"
                            class="col-md-4 col-form-label required">{{ __('Phone Number : ') }}</label>
                        <div class="col-md-8">
                            <input id="phone" type="tel"
                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone"
                                placeholder="Enter Your Phone Number...">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label for="password" class="col-md-4 col-form-label required">{{ __('Password : ') }}</label>
                        <div class="col-md-8">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Enter Your Password...">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label required">{{ __('Confirm Password : ') }}</label>
                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Enter Your Confirm Password...">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn loginpagecommonbtn w-100 fs-2 fw-bold text-white">
                                {{ __('Continue') }}
                            </button>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            Hava an account ? <a href="{{ route('login') }}">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
