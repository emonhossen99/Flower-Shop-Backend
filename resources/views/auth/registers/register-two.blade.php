<div class="container">
    <div class="row g-4 justify-content-center">
        <div class="col-md-5 mb-3 mt-3">
            <div class="login-card-two">
                <img src="{{ asset(config('settings.login_two_bg_image') ?? '') }}" alt="image">
                <div class="card-body-two">
                    <div class="heading heading-border mb-1">
                        <h2>{{ config('settings.registerpagefirsttitle') ?? '' }}</h2>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('user.register.store') }}">
                            @csrf
                            <div class="row mb-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-fname"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name" aria-label="user-fname" aria-describedby="user-email">
                                </div>
                                @error('fname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-lname"><i class="fa-solid fa-user-plus"></i></span>
                                    <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name" aria-label="user-lname" aria-describedby="user-email">
                                </div>
                                @error('lname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-email"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Enter Your Email" aria-label="user-email"
                                        aria-describedby="user-email">
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-phone"><i class="fa-solid fa-phone-volume"></i></span>
                                    <input type="tel" name="phone" class="form-control"
                                        placeholder="Enter Your Phone Number" aria-label="user-phone"
                                        aria-describedby="user-phone">
                                </div>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="row mb-2">
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

                            <div class="row mb-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="user-password_confirmation"><i
                                            class="fa-solid fa-unlock-keyhole"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Enter Your Confirm Password" aria-label="user-password_confirmation"
                                        aria-describedby="user-password_confirmation">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="loginpagecommonbtn text-white btn w-100 fw-bold fs-2">
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
    </div>
</div>
