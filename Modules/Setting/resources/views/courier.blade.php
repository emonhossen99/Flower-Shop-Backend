@extends('layouts.app')
@section('title', $title)
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">Courier Setting Form</h3>
            </div>
            <div class="card-heading">
                <h5 class="p-2">Stead Fast Setting Form</h5>
            </div>
            <div class="card-body">
                <form id="steadFastSettingForm" action="{{ route('admin.setting.stead.fast.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="Stead Fast Base Url" parantClass="col-12 col-md-6" name="steadfirstbaseurl"
                            placeholder="Enter  Stead Fast Base Url..!" errorName="steadfirstbaseurl" class="py-2" type="url"
                            value="{{ config('settings.steadfast_base_url') ?? old('steadfirstbaseurl') }}"></x-form.textbox>

                        <x-form.textbox labelName="Stead Fast Api Key " parantClass="col-12 col-md-6" name="steadfirstapikey"
                            placeholder="Enter  Stead Fast Api Key..!" errorName="steadfirstapikey" class="py-2" type="text"
                            value="{{ config('settings.steadfast_api_key') ?? old('steadfirstapikey') }}"></x-form.textbox>
                    </div>

                    <div class="row mt-3">
                        <x-form.textbox labelName="Stead Fast Secret Key" parantClass="col-12 col-md-6" name="stradfastsecretkey"
                            type="text" placeholder="Enter Stead Fast Secret Key..!" errorName="stradfastsecretkey" class="py-2"
                            value="{{ config('settings.steadfast_secret_key') ?? old('stradfastsecretkey') }}"></x-form.textbox>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none stead_fast_setting_loader" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>Submit
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-heading mt-3">
                <h5 class="p-2">Pathao Setting Form</h5>
            </div>
            <div class="card-body">
                <form id="pathaoSettingForm" action="{{ route('admin.setting.pathao.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-form.textbox labelName="Pathao Api Url" parantClass="col-12 col-md-6" name="pathaoapiurl"
                            placeholder="Enter Pathao Api Url..!" errorName="pathaoapiurl" class="py-2" type="url"
                            value="{{ config('settings.pathaoapiurl') ?? old('pathaoapiurl') }}"></x-form.textbox>

                        <x-form.textbox labelName="Pathao Client Id" parantClass="col-12 col-md-6" name="pathaoclientid"
                            placeholder="Enter  Stead Fast Api Key..!" errorName="pathaoclientid" class="py-2" type="text"
                            value="{{ config('settings.pathaoclientid') ?? old('pathaoclientid') }}"></x-form.textbox>
                    </div>

                    <div class="row mt-2">
                        <x-form.textbox labelName="Pathao Client Secret" parantClass="col-12 col-md-6" name="pathaoclientsecret"
                            placeholder="Enter Pathao Client Secret..!" errorName="pathaoclientsecret" class="py-2" type="text"
                            value="{{ config('settings.pathaoclientsecret') ?? old('pathaoclientsecret') }}"></x-form.textbox>

                        <x-form.textbox labelName="Pathao Grant Type" parantClass="col-12 col-md-6" name="pathaogranttype"
                            placeholder="Enter Grant Type..!" errorName="pathaogranttype" class="py-2" type="text"
                            value="{{ config('settings.pathaogranttype') ?? old('pathaogranttype') }}"></x-form.textbox>
                    </div>

                    <div class="row mt-2">
                        <x-form.textbox labelName="Pathao User Name" parantClass="col-12 col-md-6" name="pathaousername"
                            placeholder="Enter Pathao User Name..!" errorName="pathaousername" class="py-2" type="text"
                            value="{{ config('settings.pathaousername') ?? old('pathaousername') }}"></x-form.textbox>

                        <x-form.textbox labelName="Pathao Password" parantClass="col-12 col-md-6" name="pathaopassword"
                            placeholder="Enter Password..!" errorName="pathaopassword" class="py-2" type="text"
                            value="{{ config('settings.pathaopassword') ?? old('pathaopassword') }}"></x-form.textbox>
                    </div>
                    <div class="row mt-2">
                        <x-form.textbox labelName="Pathao Sender Name" parantClass="col-12 col-md-6" name="pathaosendername"
                            placeholder="Enter Pathao Sender Name..!" errorName="pathaosendername" class="py-2" type="text"
                            value="{{ config('settings.pathaosendername') ?? old('pathaosendername') }}"></x-form.textbox>

                        <x-form.textbox labelName="Pathao Sender Phone Number" parantClass="col-12 col-md-6" name="pathaosenderphone"
                            placeholder="Enter Sender Phone Number..!" errorName="pathaosenderphone" class="py-2" type="text"
                            value="{{ config('settings.pathaosenderphone') ?? old('pathaosenderphone') }}"></x-form.textbox>
                    </div>
                    <div class="row mt-2">
                        <x-form.textbox labelName="Pathao Store Id" parantClass="col-12 col-md-6" name="pathaostoreid"
                            placeholder="Enter Pathao Store Id..!" errorName="pathaostoreid" class="py-2" type="text"
                            value="{{ config('settings.pathaostoreid') ?? old('pathaostoreid') }}"></x-form.textbox>

                        <x-form.textbox labelName="Pathao Secret Token" parantClass="col-12 col-md-6" name="pathaosecrettoken"
                            placeholder="Enter Secret Token..!" errorName="pathaosecrettoken" class="py-2" type="text"
                            value="{{ config('settings.pathaosecrettoken') ?? old('pathaosecrettoken') }}"></x-form.textbox>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none pathao_setting_loader" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#steadFastSettingForm').on('submit', function(e) {
                e.preventDefault();
                $('.stead_fast_setting_loader').removeClass('d-none');
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
                            $('.stead_fast_setting_loader').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.stead_fast_setting_loader').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            $('#pathaoSettingForm').on('submit', function(e) {
                e.preventDefault();
                $('.pathao_setting_loader').removeClass('d-none');
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
                            $('.pathao_setting_loader').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.pathao_setting_loader').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
