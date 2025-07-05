@extends('layouts.app')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        #cropped_result img {
            width: 120px;
        }

        #cropped_result_secondary img {
            width: 120px;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Theme Setting Form Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="themeSettingForm" action="{{ route('admin.setting.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('App Name Title') }}" parantClass="col-12 col-md-6"
                            name="company_name" placeholder="{{ __f('App Name Placeholder') }}" errorName="company_name"
                            class="py-2" value="{!! config('settings.company_name') ?? old('company_name') !!}"></x-form.textbox>

                        <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="commingsoonmode"
                            labelName="{{ __f('Coming Soon Mode Title') }}" errorName="commingsoonmode">
                            <option value="0" {{ config('settings.commingsoonmode') == 0 ? 'selected' : '' }}>
                                {{ __f('OFF Title') }}
                            </option>
                            <option value="1" {{ config('settings.commingsoonmode') == 1 ? 'selected' : '' }}>
                                {{ __f('ON Title') }}
                            </option>
                        </x-form.selectbox>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="message-text"
                                        class="col-form-label">{{ __f('Company Primary Logo Title') }} :</label>
                                    <input type="file" id="companyPrimaryLogo" accept="image/*" class="form-control">
                                    <img id="companyPrimaryLogoPriview" style="max-width: 100%;">
                                    <div id="cropped_result" style="width: 120px;"></div>
                                    <canvas id="canvas" style="display:none;"></canvas>
                                    <button id="crop_button" class="btn btn-primary text-white d-none"
                                        type="button">Crop</button>
                                </div>
                                <div class="col-md-6">
                                    <label for="message-text"
                                        class="col-form-label">{{ __f('Preview Primary Logo Title') }} :</label>
                                    @if (config('settings.company_primary_logo') !== null)
                                        <img class="w-100" src="{{ asset(config('settings.company_primary_logo')) }}"
                                            alt="company primary logo">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="message-text"
                                        class="col-form-label">{{ __f('Company Secondary Logo Title') }} :</label>
                                    <input type="file" id="companySecondaryLogo" accept="image/*" class="form-control">
                                    <img id="companySecondaryLogoPriview" style="max-width: 100%;">
                                    <div id="cropped_result_secondary" style="width: 120px;"></div>
                                    <canvas id="canvas" style="display:none;"></canvas>
                                    <button id="crop_button_secondary" class="btn btn-primary text-white d-none"
                                        type="button">Crop</button>
                                </div>
                                <div class="col-md-6">
                                    <label for="message-text"
                                        class="col-form-label">{{ __f('Preview Secondary Logo Title') }} :</label>
                                    @if (config('settings.company_secondary_logo') !== null)
                                        <img class="w-100" src="{{ asset(config('settings.company_secondary_logo')) }}"
                                            alt="company secondary logo">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="text-dark font-weight-medium">{{ __f('Favicon 32*32 Title') }}</label>
                            <div>
                                <label class="third_picture" for="third__image" tabIndex="0">
                                    <span class="picture_third_image"></span>
                                </label>
                                <input type="file" name="favicon_first" id="third__image" accept="image/*">
                                <span class="text-danger error-text image-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-dark font-weight-medium">{{ __f('Favicon 16*16 Title') }}</label>
                            <div>
                                <label class="fourth_picture" for="fourth__image" tabIndex="0">
                                    <span class="picture_fourth_image"></span>
                                </label>
                                <input type="file" name="favicon_second" id="fourth__image" accept="image/*">
                                <span class="text-danger error-text threed_image-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none theme_setting_loader" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Hero Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="heroSectionSttings" action="{{ route('admin.setting.hero.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Hero Section Title Text') }}" parantClass="col-12 col-md-6"
                            name="herosectiontitle" placeholder="{{ __f('Hero Section Title Text Placeholder') }}"
                            errorName="herosectiontitle" class="py-2" type="text"
                            value="{!! config('settings.herosectiontitle') ?? old('herosectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Hero Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="herosectionsubtitle"
                            placeholder="{{ __f('Hero Section Sub Title Text Placeholder') }}"
                            errorName="herosectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.herosectionsubtitle') ?? old('herosectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Hero Section Button Title Text') }}"
                            parantClass="col-12 col-md-6" name="herosectionbtntitle"
                            placeholder="{{ __f('Hero Section Button Title Text Placeholder') }}"
                            errorName="herosectionbtntitle" class="py-2" type="text"
                            value="{!! config('settings.herosectionbtntitle') ?? old('herosectionbtntitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Hero Section Button URL Title Text') }}"
                            parantClass="col-12 col-md-6" name="herosectionbtnurltitle"
                            placeholder="{{ __f('Hero Section Button URL Title Text Placeholder') }}"
                            errorName="herosectionbtnurltitle" class="py-2" type="text"
                            value="{!! config('settings.herosectionbtnurltitle') ?? old('herosectionbtnurltitle') !!}"></x-form.textbox>
                    </div>


                    <div class="row mt-3">
                        <x-form.textarea id="summernote" labelName="{{ __f('Hero Section Short Description Title') }}"
                            parantClass="col-12 col-md-6" name="herosectionshortdescription" type="text"
                            placeholder="{{ __f('Hero Section Short Description Placeholder') }}"
                            errorName="herosectionshortdescription" class="summernote"
                            value="{{ config('settings.herosectionshortdescription') ?? old('herosectionshortdescription') }}"></x-form.textarea>

                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label
                                    class="text-dark font-weight-medium">{{ __f('Hero Section Background Image Title') }}
                                    <span
                                        id="image-size-guide">{{ __f('Hero Section Background Image Dimensions') }}</span></label>
                                <div>
                                    <label class="seventh_picture" for="seventh__image" tabIndex="0">
                                        <span class="picture_seventh_image"></span>
                                    </label>
                                    <input type="file" name="hero_section_bg_image" id="seventh__image">
                                    <span class="text-danger error-text image-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none hero_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Special Moments Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="specialMomentsSectionSttings" action="{{ route('admin.setting.special.moments.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Special Moments Section Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialmomentssectiontitle"
                            placeholder="{{ __f('Special Moments Section Title Text Placeholder') }}"
                            errorName="specialmomentssectiontitle" class="py-2" type="text"
                            value="{!! config('settings.specialmomentssectiontitle') ?? old('specialmomentssectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Special Moments Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialmomentssectionsubtitle"
                            placeholder="{{ __f('Special Moments Section Sub Title Text Placeholder') }}"
                            errorName="specialmomentssectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.specialmomentssectionsubtitle') ?? old('specialmomentssectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Special Moments Section Button Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialmomentssectionbtntitle"
                            placeholder="{{ __f('Special Moments Section Button Title Text Placeholder') }}"
                            errorName="specialmomentssectionbtntitle" class="py-2" type="text"
                            value="{!! config('settings.specialmomentssectionbtntitle') ?? old('specialmomentssectionbtntitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Special Moments Section Button URL Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialmomentssectionbtnurltitle"
                            placeholder="{{ __f('Special Moments Section Button URL Title Text Placeholder') }}"
                            errorName="specialmomentssectionbtnurltitle" class="py-2" type="text"
                            value="{!! config('settings.specialmomentssectionbtnurltitle') ?? old('specialmomentssectionbtnurltitle') !!}"></x-form.textbox>
                    </div>


                    <div class="row mt-3">
                        <x-form.textarea id="summernote"
                            labelName="{{ __f('Special Moments Section Short Description Title') }}"
                            parantClass="col-12 col-md-6" name="specialmomentssectionshortdescription" type="text"
                            placeholder="{{ __f('Special Moments Section Short Description Placeholder') }}"
                            errorName="specialmomentssectionshortdescription" class="summernote"
                            value="{{ config('settings.specialmomentssectionshortdescription') ?? old('specialmomentssectionshortdescription') }}"></x-form.textarea>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label
                                        class="text-dark font-weight-medium">{{ __f('Special Moments Section First Image Title') }}
                                        <span
                                            id="image-size-guide">{{ __f('Special Moments Section First Image Dimensions') }}</span></label>
                                    <div>
                                        <label class="eghit_picture" for="eghit__image" tabIndex="0">
                                            <span class="picture_eghit_image"></span>
                                        </label>
                                        <input type="file" name="special_moments_section_first_image"
                                            id="eghit__image">
                                        <span class="text-danger error-text image-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label
                                        class="text-dark font-weight-medium">{{ __f('Special Moments Section Second Image Title') }}<span
                                            id="image-size-guide">{{ __f('Special Moments Section Second Image Dimensions') }}</span></label>
                                    <div>
                                        <label class="nine_picture" for="nine__image" tabIndex="0">
                                            <span class="picture_nine_image"></span>
                                        </label>
                                        <input type="file" name="special_moments_section_second_image"
                                            id="nine__image">
                                        <span class="text-danger error-text image-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none special_moments_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Latest Additions Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="latestadditionsSectionSttings" action="{{ route('admin.setting.latest.additions.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Latest Additions Section Title Text') }}"
                            parantClass="col-12 col-md-6" name="latestadditionssectiontitle"
                            placeholder="{{ __f('Latest Additions Section Title Text Placeholder') }}"
                            errorName="latestadditionssectiontitle" class="py-2" type="text"
                            value="{!! config('settings.latestadditionssectiontitle') ?? old('latestadditionssectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Latest Additions Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="latestadditionssectionsubtitle"
                            placeholder="{{ __f('Latest Additions Section Sub Title Text Placeholder') }}"
                            errorName="latestadditionssectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.latestadditionssectionsubtitle') ?? old('latestadditionssectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Latest Additions Section Description Text') }}"
                            parantClass="col-12 col-md-6" name="latestadditionssectionbtntitle"
                            placeholder="{{ __f('Latest Additions Section Short Description Text Placeholder') }}"
                            errorName="latestadditionssectionbtntitle" class="py-2" type="text"
                            value="{!! config('settings.latestadditionssectionbtntitle') ?? old('latestadditionssectionbtntitle') !!}"></x-form.textbox>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none latestadditions_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Special Offer Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="specialOfferSectionSttings" action="{{ route('admin.setting.special.offer.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Special Offer Section Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialoffersectiontitle"
                            placeholder="{{ __f('Special Offer Section Title Text Placeholder') }}"
                            errorName="specialoffersectiontitle" class="py-2" type="text"
                            value="{!! config('settings.specialoffersectiontitle') ?? old('specialoffersectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Special Offer Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialoffersectionsubtitle"
                            placeholder="{{ __f('Special Offer Section Sub Title Text Placeholder') }}"
                            errorName="specialoffersectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.specialoffersectionsubtitle') ?? old('specialoffersectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Special Offer Section Button Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialoffersectionbtntitle"
                            placeholder="{{ __f('Special Offer Section Button Title Text Placeholder') }}"
                            errorName="specialoffersectionbtntitle" class="py-2" type="text"
                            value="{!! config('settings.specialoffersectionbtntitle') ?? old('specialoffersectionbtntitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Special Offer Section Button URL Title Text') }}"
                            parantClass="col-12 col-md-6" name="specialoffersectionbtnurltitle"
                            placeholder="{{ __f('Special Offer Section Button URL Title Text Placeholder') }}"
                            errorName="specialoffersectionbtnurltitle" class="py-2" type="text"
                            value="{!! config('settings.specialoffersectionbtnurltitle') ?? old('specialoffersectionbtnurltitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label
                                    class="text-dark font-weight-medium">{{ __f('Special Offer Section Background Image Title') }}
                                    <span
                                        id="image-size-guide">{{ __f('Special Offer Section Background Image Dimensions') }}</span></label>
                                <div>
                                    <label class="ten_picture" for="ten__image" tabIndex="0">
                                        <span class="picture_ten_image"></span>
                                    </label>
                                    <input type="file" name="special_offer_section_image" id="ten__image">
                                    <span class="text-danger error-text image-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none special_offer_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Best Selling Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="bestSellingSectionSttings" action="{{ route('admin.setting.best.selling.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Best Selling Section Title Text') }}"
                            parantClass="col-12 col-md-6" name="bestsellingsectiontitle"
                            placeholder="{{ __f('Best Selling Section Title Text Placeholder') }}"
                            errorName="bestsellingsectiontitle" class="py-2" type="text"
                            value="{!! config('settings.bestsellingsectiontitle') ?? old('bestsellingsectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Best Selling Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="bestsellingsectionsubtitle"
                            placeholder="{{ __f('Best Selling Section Sub Title Text Placeholder') }}"
                            errorName="bestsellingsectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.bestsellingsectionsubtitle') ?? old('bestsellingsectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Best Selling Section Description Title Text') }}"
                            parantClass="col-12 col-md-6" name="bestsellingsectiondescriptiontitle"
                            placeholder="{{ __f('Best Selling Section Description Title Text Placeholder') }}"
                            errorName="bestsellingsectiondescriptiontitle" class="py-2" type="text"
                            value="{!! config('settings.bestsellingsectiondescriptiontitle') ?? old('bestsellingsectiondescriptiontitle') !!}"></x-form.textbox>
                        <div class="col-md-6">
                            @php
                                $category_section = json_decode(config('settings.bestselling_category_section'));
                            @endphp
                            <label for="">Section Category <span class="text-warning fs-7"></span></label>
                            <select class="form-select" id="multiple-select2-field" data-placeholder="Choose a Category"
                                multiple name="bestselling_category_section[]">
                                @forelse ($categories as $categorie)
                                    <option value="{{ $categorie->id ?? '' }}"
                                        @isset($category_section) {{ in_array($categorie->id, $category_section) ? 'selected' : '' }} @endisset>
                                        {{ $categorie->name ?? '' }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none best_selling_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Testimonail Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="testimonailSectionSttings" action="{{ route('admin.setting.testimonail.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Testimonail Section Title Text') }}"
                            parantClass="col-12 col-md-6" name="testimonailsectiontitle"
                            placeholder="{{ __f('Testimonail Section Title Text Placeholder') }}"
                            errorName="testimonailsectiontitle" class="py-2" type="text"
                            value="{!! config('settings.testimonailsectiontitle') ?? old('testimonailsectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Testimonail Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="testimonailsectionsubtitle"
                            placeholder="{{ __f('Testimonail Section Sub Title Text Placeholder') }}"
                            errorName="testimonailsectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.testimonailsectionsubtitle') ?? old('testimonailsectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Testimonail Section Description Title Text') }}"
                            parantClass="col-12 col-md-6" name="testimonailsectiondescriptiontitle"
                            placeholder="{{ __f('Testimonail Section Description Title Text Placeholder') }}"
                            errorName="testimonailsectiondescriptiontitle" class="py-2" type="text"
                            value="{!! config('settings.testimonailsectiondescriptiontitle') ?? old('testimonailsectiondescriptiontitle') !!}"></x-form.textbox>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none testimonail_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Call To Action Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="callToActionSectionSttings" action="{{ route('admin.setting.call.to.action.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Call To Action Section Title Text') }}"
                            parantClass="col-12 col-md-6" name="calltoactionsectiontitle"
                            placeholder="{{ __f('Call To Action Section Title Text Placeholder') }}"
                            errorName="calltoactionsectiontitle" class="py-2" type="text"
                            value="{!! config('settings.calltoactionsectiontitle') ?? old('calltoactionsectiontitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Call To Action Section Sub Title Text') }}"
                            parantClass="col-12 col-md-6" name="calltoactionsectionsubtitle"
                            placeholder="{{ __f('Call To Action Section Sub Title Text Placeholder') }}"
                            errorName="calltoactionsectionsubtitle" class="py-2" type="text"
                            value="{!! config('settings.calltoactionsectionsubtitle') ?? old('calltoactionsectionsubtitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Call To Action Section Button Title Text') }}"
                            parantClass="col-12 col-md-6" name="calltoactionsectionbtntitle"
                            placeholder="{{ __f('Call To Action Section Button Title Text Placeholder') }}"
                            errorName="calltoactionsectionbtntitle" class="py-2" type="text"
                            value="{!! config('settings.calltoactionsectionbtntitle') ?? old('calltoactionsectionbtntitle') !!}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Call To Action Section Button URL Title Text') }}"
                            parantClass="col-12 col-md-6" name="calltoactionsectionbtnurltitle"
                            placeholder="{{ __f('Call To Action Section Button URL Title Text Placeholder') }}"
                            errorName="calltoactionsectionbtnurltitle" class="py-2" type="text"
                            value="{!! config('settings.calltoactionsectionbtnurltitle') ?? old('calltoactionsectionbtnurltitle') !!}"></x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label
                                    class="text-dark font-weight-medium">{{ __f('Call To Action Section Background Image Title') }}
                                    <span
                                        id="image-size-guide">{{ __f('Call To Action Section Background Image Dimensions') }}</span></label>
                                <div>
                                    <label class="eleven_picture" for="eleven__image" tabIndex="0">
                                        <span class="picture_eleven_image"></span>
                                    </label>
                                    <input type="file" name="call_to_action_section_image" id="eleven__image">
                                    <span class="text-danger error-text image-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none call_to_action_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Footer Section Settings Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="footerSectionSettings" action="{{ route('admin.setting.footer.section.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textarea labelName="{{ __f('Footer Section Description Title') }}"
                            parantClass="col-12 col-md-12" name="footer_section_description_text" class="summernote"
                            type="text" placeholder="{{ __f('Footer Section Description Placeholder') }}"
                            errorName="footer_section_description_text"
                            value="{{ config('settings.footer_section_description_text') ?? old('footer_section_description_text') }}"></x-form.textarea>
                    </div>
                    <div class="row mt-3">
                        <x-form.textbox labelName="{{ __f('Footer Section Second Grid Title Text') }}"
                            parantClass="col-12 col-md-6" name="footer_second_gird_title"
                            placeholder="{{ __f('Footer Section Second Grid Title Text Placeholder') }}"
                            errorName="footer_second_gird_title" class="py-2" type="text"
                            value="{{ config('settings.footer_second_gird_title') ?? old('footer_second_gird_title') }}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Footer Section Third Grid Text Title') }}"
                            parantClass="col-12 col-md-6" name="footer_section_third_title"
                            placeholder="{{ __f('Footer Section Third Grid Title Text Placeholder') }}"
                            errorName="footer_section_third_title" class="py-2" type="text"
                            value="{{ config('settings.footer_section_third_title') ?? old('footer_section_third_title') }}"></x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <x-form.textbox labelName="{{ __f('Footer Section Email Title Text') }}"
                            parantClass="col-12 col-md-6" name="footer_section_email"
                            placeholder="{{ __f('Footer Section Email Title Text Placeholder') }}"
                            errorName="footer_section_email" class="py-2" type="text"
                            value="{{ config('settings.footer_section_email') ?? old('footer_section_email') }}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Footer Section Phone Title Text') }}"
                            parantClass="col-12 col-md-6" name="footer_section_phone"
                            placeholder="{{ __f('Footer Section Phone Title Text Placeholder') }}"
                            errorName="footer_section_phone" class="py-2" type="tel"
                            value="{{ config('settings.footer_section_phone') ?? old('footer_section_phone') }}"></x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <x-form.textbox labelName="{{ __f('Footer Section Copyright Title Text') }}"
                            parantClass="col-12 col-md-6" name="footer_section_copyright"
                            placeholder="{{ __f('Footer Section Copyright Title Text Placeholder') }}"
                            errorName="footer_section_copyright" class="py-2" type="text"
                            value="{{ config('settings.footer_section_copyright') ?? old('footer_section_copyright') }}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Footer Section Facebook Url Title') }}"
                            parantClass="col-12 col-md-6" name="footer_section_facebook_url"
                            placeholder="{{ __f('Footer Section Facebook Url Placeholder') }}"
                            errorName="footer_section_facebook_url" class="py-2" type="text"
                            value="{{ config('settings.footer_section_facebook_url') ?? old('footer_section_facebook_url') }}"></x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <x-form.textbox labelName="{{ __f('Footer Section Twitter Url Title') }}"
                            parantClass="col-12 col-md-6" name="footer_section_twitter_url"
                            placeholder="{{ __f('Footer Section Twitter Url Placeholder') }}"
                            errorName="footer_section_twitter_url" class="py-2" type="text"
                            value="{{ config('settings.footer_section_twitter_url') ?? old('footer_section_twitter_url') }}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Footer Section Instagram Url Title') }}"
                            parantClass="col-12 col-md-6" name="footer_section_instagram_url"
                            placeholder="{{ __f('Footer Section Instagram Url Placeholder') }}"
                            errorName="footer_section_instagram_url" class="py-2" type="text"
                            value="{{ config('settings.footer_section_instagram_url') ?? old('footer_section_instagram_url') }}"></x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <x-form.textbox labelName="{{ __f('Footer Section Youtube Url Title') }}"
                            parantClass="col-12 col-md-6" name="footer_section_youtube_url"
                            placeholder="{{ __f('Footer Section Youtube Url Placeholder') }}"
                            errorName="footer_section_youtube_url" class="py-2" type="text"
                            value="{{ config('settings.footer_section_youtube_url') ?? old('footer_section_youtube_url') }}"></x-form.textbox>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none footer_setting" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#multiple-select-field, #multiple-select2-field').each(function() {
                $(this).select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    closeOnSelect: false,
                });
            });
        });
    </script>
    <script>
        $(function() {
            ImagePriviewInsert('third__image', 'picture_third_image',
                '{{ __f('Choose Favicon 32*32 Placeholder') }}');
            ImagePriviewInsert('fourth__image', 'picture_fourth_image',
                '{{ __f('Choose Favicon 16*16 Placeholder') }}');
            ImagePriviewInsert('seventh__image', 'picture_seventh_image',
                '{{ __f('Hero Section Background Image Title') }}');
            ImagePriviewInsert('eghit__image', 'picture_eghit_image',
                '{{ __f('Special Moments Section First Image Title') }}');
            ImagePriviewInsert('nine__image', 'picture_nine_image',
                '{{ __f('Special Moments Section Second Image Title') }}');
            ImagePriviewInsert('ten__image', 'picture_ten_image',
                '{{ __f('Special Offer Section Background Image Title') }}');
            ImagePriviewInsert('eleven__image', 'picture_eleven_image',
                '{{ __f('Call To Action Section Background Image Title') }}');
        });


        var companyFaviconFirst = "{{ config('settings.favicon_first') ?? '' }}";
        var companyFaviconSecond = "{{ config('settings.favicon_second') ?? '' }}";
        var herosectionbgImage = "{{ config('settings.hero_section_bg_image') ?? '' }}";
        var specialmomentsfirstImage = "{{ config('settings.special_moments_section_first_image') ?? '' }}";
        var specialmomentssecondImage = "{{ config('settings.special_moments_section_second_image') ?? '' }}";
        var specialoffersImage = "{{ config('settings.special_offer_section_image') ?? '' }}";
        var calltoactionImage = "{{ config('settings.call_to_action_section_image') ?? '' }}";

        if (companyFaviconFirst != '') {
            var myFaviconFirstData = "{{ asset(config('settings.favicon_first') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('third__image', 'picture_third_image',
                    '{{ __f('Choose Favicon 32*32 Placeholder') }}',
                    myFaviconFirstData);
            });
        }

        if (companyFaviconSecond != '') {
            var myFaviconSecondData = "{{ asset(config('settings.favicon_second') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('fourth__image', 'picture_fourth_image',
                    '{{ __f('Choose Favicon 16*16 Placeholder') }}',
                    myFaviconSecondData);
            });
        }

        if (herosectionbgImage != '') {
            var myHerosection = "{{ asset(config('settings.hero_section_bg_image') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('seventh__image', 'picture_seventh_image',
                    '{{ __f('Hero Section Background Image Title') }}', myHerosection);
            });
        }

        if (specialmomentsfirstImage != '') {
            var myspecialmomentsfirst = "{{ asset(config('settings.special_moments_section_first_image') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('eghit__image', 'picture_eghit_image',
                    '{{ __f('Special Moments Section First Image Title') }}', myspecialmomentsfirst);
            });
        }

        if (specialmomentssecondImage != '') {
            var myspecialmomentssecond = "{{ asset(config('settings.special_moments_section_second_image') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('nine__image', 'picture_nine_image',
                    '{{ __f('Special Moments Section Second Image Title') }}', myspecialmomentssecond);
            });
        }

        if (specialoffersImage != '') {
            var myspecialoffers = "{{ asset(config('settings.special_offer_section_image') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('ten__image', 'picture_ten_image',
                    '{{ __f('Special Offer Section Background Image Title') }}', myspecialoffers);
            });
        }

        if (calltoactionImage != '') {
            var mycalltoactionImage = "{{ asset(config('settings.call_to_action_section_image') ?? '') }}";
            $(function() {
                ImagePriviewUpdate('eleven__image', 'picture_eleven_image',
                    '{{ __f('Call To Action Section Background Image Title') }}', mycalltoactionImage);
            });
        }



        $(document).ready(function() {
            let cropper;
            let secondaryCropper;

            document.getElementById('companyPrimaryLogo').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('companyPrimaryLogoPriview').src = event.target.result;
                        if (cropper) cropper.destroy();
                        cropper = new Cropper(document.getElementById('companyPrimaryLogoPriview'), {
                            aspectRatio: false,
                            viewMode: 1,
                            autoCropArea: 1,
                            cropBoxResizable: false,
                            cropBoxMovable: true,
                        });
                    };
                    reader.readAsDataURL(file);
                    $('#crop_button').removeClass('d-none');
                }
            });

            document.getElementById('companySecondaryLogo').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('companySecondaryLogoPriview').src = event.target
                            .result;
                        if (secondaryCropper) secondaryCropper.destroy();
                        secondaryCropper = new Cropper(document.getElementById(
                            'companySecondaryLogoPriview'), {
                            aspectRatio: false,
                            viewMode: 1,
                            autoCropArea: 1,
                            cropBoxResizable: false,
                            cropBoxMovable: true,
                        });
                    };
                    reader.readAsDataURL(file);
                    $('#crop_button_secondary').removeClass('d-none');
                }
            });


            document.getElementById('crop_button').addEventListener('click', function() {
                var imgurl = cropper.getCroppedCanvas().toDataURL();
                var img = document.createElement("img");
                img.src = imgurl;
                $('.cropper-bg').css('display', 'none');
                document.getElementById("cropped_result").innerHTML = '';
                document.getElementById("cropped_result").appendChild(img);
            });

            document.getElementById('crop_button_secondary').addEventListener('click', function() {
                var imgurl = secondaryCropper.getCroppedCanvas().toDataURL();
                var img = document.createElement("img");
                img.src = imgurl;
                $('.cropper-bg').css('display', 'none');
                document.getElementById("cropped_result_secondary").innerHTML = '';
                document.getElementById("cropped_result_secondary").appendChild(img);
            });

            $('#themeSettingForm').on('submit', function(e) {
                e.preventDefault();
                $('.theme_setting_loader').removeClass('d-none');
                let formData = new FormData(this);
                if (cropper && secondaryCropper) {
                    cropper.getCroppedCanvas().toBlob(function(primaryBlob) {
                        formData.append('company_primary_logo', primaryBlob, 'cropped.jpg');
                        secondaryCropper.getCroppedCanvas().toBlob(function(secondaryBlob) {
                            formData.append('company_secondary_logo', secondaryBlob,
                                'croppedsecondary.jpg');
                            callTOThemeSettingFrom(formData);
                        });
                    });
                } else if (cropper) {
                    const canvas = cropper.getCroppedCanvas();
                    canvas.toBlob(function(blob) {
                        formData.append('company_primary_logo', blob, 'cropped.jpg');
                        callTOThemeSettingFrom(formData);
                    });
                } else if (secondaryCropper) {
                    const secondaryCanvas = secondaryCropper.getCroppedCanvas();
                    secondaryCanvas.toBlob(function(blob) {
                        formData.append('company_secondary_logo', blob, 'croppedsecondary.jpg');
                        callTOThemeSettingFrom(formData);
                    });
                } else {
                    callTOThemeSettingFrom(formData);
                };
            });

            function callTOThemeSettingFrom(formData) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.theme_setting_loader').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.theme_setting_loader').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            }




            $('#heroSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.hero_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.hero_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.hero_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#specialMomentsSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.special_moments_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.special_moments_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.special_moments_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#latestadditionsSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.latestadditions_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.latestadditions_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.latestadditions_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#specialOfferSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.special_offer_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.special_offer_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.special_offer_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#bestSellingSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.best_selling_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.best_selling_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.best_selling_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#testimonailSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.testimonail_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.testimonail_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.testimonail_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#callToActionSectionSttings').on('submit', function(e) {
                e.preventDefault();
                $('.call_to_action_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.call_to_action_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.call_to_action_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#footerSectionSettings').on('submit', function(e) {
                e.preventDefault();
                $('.footer_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.footer_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.footer_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });










            $('#shopFromSettingForm').on('submit', function(e) {
                e.preventDefault();
                $('.shop_page_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.shop_page_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.shop_page_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#footerSettings').on('submit', function(e) {
                e.preventDefault();
                $('.footer_setting').removeClass('d-none');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.footer_setting').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.footer_setting').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
