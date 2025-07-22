<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('index') }}">
            <span class="align-middle"><img src="{{ asset(config('settings.company_secondary_logo')) }}"
                    alt="Logo" width="105" height="25"></span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{ __f('Pages Title') }}
            </li>
            @if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2))
                <li class="sidebar-item {{ $activeDashboard ?? '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard.index') }}">
                        <i class="align-middle" data-feather="grid"></i> <span
                            class="align-middle">{{ __f('Dashboard Title') }}</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-item {{ $activeProductMenu ?? '' }}">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="false">
                    <i class="align-middle" data-feather="list"></i><span>{{ __f('Products Title') }}</span>
                </a>

                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse {{ $showProductMenu ?? '' }}"
                    data-bs-parent="#sidebar">
                    @if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2))
                        <li class="sidebar-item {{ $activeCategoryCreateMenu ?? '' }}"><a class="sidebar-link"
                                href="{{ route('admin.category.create') }}">{{ __f('Add Category Title') }} </a></li>
                        <li class="sidebar-item {{ $activeCategoryMenu ?? '' }}"><a class="sidebar-link"
                                href="{{ route('admin.category.index') }}">{{ __f('Category List Title') }}</a></li>
                        <li class="sidebar-item {{ $showProductCreateMenu ?? '' }}"><a class="sidebar-link"
                                href="{{ route('admin.product.create') }}">{{ __f('Add Product Title') }} </a></li>
                        <li class="sidebar-item {{ $activeProductListMenu ?? '' }}"><a class="sidebar-link"
                                href="{{ route('admin.product.index') }}">{{ __f('Product List Title') }} </a></li>
                        {{-- <li class="sidebar-item {{ $activeReveiwMenu ?? '' }}"><a class="sidebar-link"
                                href="{{ route('admin.review.index') }}">{{ __f('Product Review Title') }}</a></li> --}}
                    @endif
                </ul>
            </li>
            @if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2))
                <li class="sidebar-item {{ $activeParentOrderMenu ?? '' }}">
                    <a data-bs-target="#ordersMenu" data-bs-toggle="collapse" class="sidebar-link"
                        aria-expanded="false">
                        <i class="align-middle" data-feather="shopping-bag"></i><span>{{ __f('Orders Title') }}</span>
                    </a>
                    <ul id="ordersMenu" class="sidebar-dropdown list-unstyled collapse {{ $showOrderMenu ?? '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ $activeOrderMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.order.index') }}">{{ __f('Order List Title') }}</a>
                        </li>
                        <li class="sidebar-item {{ $activeFraudMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.fraudchecker.index') }}">{{ __f('Fraud Checker Title') }}</a>
                        </li>
                    </ul>
                </li>
            @endif


            @if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2))
                <li class="sidebar-header">
                    {{ __f('Theme Settings Title') }}
                </li>
                <li class="sidebar-item {{ $activeThemeMenu ?? '' }}">
                    <a data-bs-target="#themeSettingsMenu" data-bs-toggle="collapse" class="sidebar-link"
                        aria-expanded="false">
                        <i class="align-middle" data-feather="aperture"></i><span>{{ __f('Settings Title') }}</span>
                    </a>

                    <ul id="themeSettingsMenu"
                        class="sidebar-dropdown list-unstyled collapse {{ $showThemeMenu ?? '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ $activeThemeSettingMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.setting.index') }}">{{ __f('Theme Settings Title') }}</a>
                        </li>

                        {{-- <li class="sidebar-item {{ $activeTypographySettingMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.setting.typography.index') }}">{{ __f('Typography Settings Title') }}</a>
                        </li> --}}
                    </ul>
                </li>

                <li class="sidebar-item {{ $activeParentSliderMenu ?? '' }}">
                    <a data-bs-target="#homeSettingsMenu" data-bs-toggle="collapse" class="sidebar-link"
                        aria-expanded="false">
                        <i class="align-middle"
                            data-feather="settings"></i><span>{{ __f('Home Settings Title') }}</span>
                    </a>

                    <ul id="homeSettingsMenu"
                        class="sidebar-dropdown list-unstyled collapse {{ $showSliderMenu ?? '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ $activeMenuCreateMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.menu.create') }}">{{ __f('Add Menu Title') }}</a>
                        </li>
                        <li class="sidebar-item {{ $activeMenuMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.menu.index') }}">{{ __f('Menu List Title') }}</a>
                        </li>

                        <li class="sidebar-item {{ $activeFeatureCreateMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.feature.create') }}">{{ __f('Add Feature Title') }}</a>
                        </li>
                        <li class="sidebar-item {{ $activeFeatureMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.feature.index') }}">{{ __f('Feature List Title') }}</a>
                        </li>

                        <li class="sidebar-item {{ $activeTestimonaiCreateMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.testimonail.create') }}">{{ __f('Add Testimonail Title') }}</a>
                        </li>
                        <li class="sidebar-item {{ $activeTestimonailListMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.testimonail.index') }}">{{ __f('Testimonail List Title') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2))
                <li class="sidebar-header">
                    {{ __f('Language Settings Title') }}
                </li>
                <li class="sidebar-item {{ $activeLanguageMenu ?? '' }}">
                    <a data-bs-target="#languagesettings" data-bs-toggle="collapse" class="sidebar-link"
                        aria-expanded="false">
                        <i class="align-middle" data-feather="globe"></i><span>
                            {{ __f('Language Settings Title') }}</span>
                    </a>
                    <ul id="languagesettings"
                        class="sidebar-dropdown list-unstyled collapse {{ $showLanguageMenu ?? '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ $activeLanguageCreateMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.language.create') }}">{{ __f('Add Language Title') }}
                            </a>
                        </li>
                        <li class="sidebar-item {{ $activeLanguageListMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.language.index') }}">{{ __f('Language List Title') }}</a>
                        </li>
                        <li class="sidebar-item {{ $activeWebsiteTranslateMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.language.website.translate', ['lang' => app()->getLocale()]) }}">{{ __f('Website Translate Title') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2))
                <li class="sidebar-header">
                    {{ __f('Database Settings Title') }}
                </li>
                <li class="sidebar-item {{ $activeDatabaseResetMenu ?? '' }}">
                    <a data-bs-target="#databaseReset" data-bs-toggle="collapse" class="sidebar-link"
                        aria-expanded="false">
                        <i class="align-middle"
                            data-feather="database"></i><span>{{ __f('Database Reset Title') }}</span>
                    </a>
                    <ul id="databaseReset"
                        class="sidebar-dropdown list-unstyled collapse {{ $showDatabaseResetMenu ?? '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ $activeDatabaseListMenu ?? '' }}">
                            <a class="sidebar-link"
                                href="{{ route('admin.databasereset.index') }}">{{ __f('Database List Title') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
    </div>
</nav>
