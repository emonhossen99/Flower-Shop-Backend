@extends('layouts.app')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-gallary.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multiple.css') }}">
    <style>
        #product-image-size-guide {
            font-size: 12px;
            color: #f7560e;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Testimonail Edit Title') }}</h3>
            </div>

            <div class="card-body">
                <form id="testimonailUpdateForm" action="{{ route('admin.testimonail.update', $testimonail->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4 mb-2">
                        <input type="hidden" name="update_id" value="{{ $testimonail->id }}">
                        <x-form.textbox labelName="{{ __f('User Name Label Title') }}" parantClass="col-12 col-md-6"
                            name="name" required="required" placeholder="{{ __f('User Name Label Placeholder') }}"
                            errorName="name" class="py-2" value="{{ $testimonail->name ??  old('name') }}"></x-form.textbox>

                        <x-form.textbox labelName="{{ __f('User Designation Label Title') }}" parantClass="col-12 col-md-6"
                            name="designation" required="required" placeholder="{{ __f('User Designation Placeholder') }}"
                            errorName="designation" class="py-2" value="{{ $testimonail->designation ??  old('designation') }}" type="text"></x-form.textbox>
                    </div>
                    <div class="row g-4 mb-2">
                        <x-form.textbox labelName="{{ __f('User Ratting Label Title') }}" parantClass="col-12 col-md-6"
                            name="ratting" required="required" placeholder="{{ __f('User Ratting Placeholder') }}"
                            errorName="ratting" class="py-2" value="{{ $testimonail->ratting ??  old('ratting') }}" type="number" min="1" max="5"></x-form.textbox>

                        <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="status"
                                required="required" labelName="{{ __f('Status Label Title') }}" errorName="status">
                                <option value="1" {{ $testimonail->status == '1' ? 'selected' : '' }} >{{ __f('Status Publish Title') }}</option>
                                <option value="0" {{ $testimonail->status == '0' ? 'selected' : '' }} >{{ __f('Status Pending Title') }}</option>
                            </x-form.selectbox>
                    </div>
                    <div class="row g-4 mb-2">
                        <x-form.textarea labelName="{{ __f('User Review Label Title') }}" class="summernote"
                            parantClass="col-12  col-md-6" id="summernote" name="review" required="required"
                            errorName="review" value="{{ $testimonail->review ??  old('review') }}"></x-form.textarea>

                        <div class="col-12  col-md-6">
                            <label class="text-dark font-weight-medium">{{ __f('User Image Title') }} <span
                                    id="product-image-size-guide">({{ __f('User Image Dimensions') }})</span></label>
                            <div>
                                <label class="first__picture" for="first__image" tabIndex="0">
                                    <span class="picture__first"></span>
                                </label>
                                <input type="file" name="image" id="first__image" accept="image/*">
                                <span class="text-danger error-text image-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-2">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none" role="status">
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
    <script>
        $(function() {
            ImagePriviewInsert('first__image', 'picture__first', '{{ __f('User Image Title') }}');
        });

        var userimage = "{{ $testimonail->image ?? '' }}";

        if (userimage != '') {
            var myFData = "{{ asset($testimonail->image ?? '') }}";
            $(function() {
                ImagePriviewUpdate('first__image', 'picture__first', '{{ __f('User Image Title') }}',
                    myFData);
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var projectRedirectUrl = "{{ route('admin.testimonail.index') }}";
            $('#testimonailUpdateForm').on('submit', function(e) {
                e.preventDefault();
                $('.spinner-border').removeClass('d-none');
                $('.error-text').text('');
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
                                window.location.href = projectRedirectUrl;
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.spinner-border').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.spinner-border').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
