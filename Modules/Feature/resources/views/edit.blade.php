@extends('layouts.app')
@section('title',$title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-style.css') }}">
@endpush
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Feature Edit Form Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="featureEditForm" action="{{ route('admin.feature.update',$feature->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Feature Title') }}" parantClass="col-12 col-md-6" name="title" required="required"
                            placeholder="{{ __f('Feature Title Placeholder') }}" errorName="title" class="py-2"
                            value="{{ $feature->title ?? old('title') }}"></x-form.textbox>

                        <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="status"
                            required="required" labelName="{{ __f('Status Label Title') }}" errorName="status">
                            <option value="1" {{ $feature->status == '1' ? 'selected' : '' }}>{{ __f("Status Publish Title") }}</option>
                            <option value="0" {{ $feature->status == '0' ? 'selected' : '' }}>{{ __f("Status Pending Title") }}</option>
                        </x-form.selectbox>
                    </div>
                    <div class="row">
                        <x-form.textarea id="summernote" labelName="{{ __f('Feature Description Title') }}"
                            parantClass="col-12 col-md-6" name="description" type="text"
                            placeholder="{{ __f('Feature Description Placeholder') }}"
                             required="required" errorName="description" class="summernote"
                            value="{{ $feature->description ?? old('description') }}"></x-form.textarea>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <div class="spinner-border text-light d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f("Submit Title") }}
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
            const projectRedirectUrl = "{{ route('admin.feature.index') }}";
            $('#featureEditForm').on('submit', function(e) {
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
