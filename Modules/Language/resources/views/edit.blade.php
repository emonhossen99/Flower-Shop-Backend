@extends('layouts.app')
@section('title', $title)
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Language Edit Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="expenseForm" action="{{ route('admin.language.updates',['id' => $language->id ]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <x-form.textbox labelName="{{ __f('Language Name label Title') }}" type="text" required="required" name="name" errorName="name"
                                class="py-2" placeholder="{{ __f('Language Name Placeholder') }}" value="{{ $language->name ?? old('name') }}">
                            </x-form.textbox>
                        </div>
                        <div class="col-12 col-md-6">
                            <x-form.textbox labelName="{{ __f('Language Code label Title') }}" type="text" required="required" name="code" errorName="code"
                                class="py-2" placeholder="{{ __f('Language Code Placeholder') }}" value="{{ $language->code ?? old('code') }}">
                            </x-form.textbox>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="direction" required="required"
                            labelName="{{ __f('Direction Title') }}">
                            <option value="ltr" {{ $language->direction == 'ltr' ? 'selected' : '' }}>{{ __f('Left To Right Title') }}</option>
                            <option value="rtt" {{ $language->direction == 'rtt' ? 'selected' : '' }}>{{ __f('Right To Left Title') }}</option>
                        </x-form.selectbox>
                        <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="status" required="required"
                            labelName="{{ __f('Status Label Title') }}">
                            <option value="1" {{ $language->status == '1' ? 'selected' : '' }}>{{ __f('Status Publish Title') }}</option>
                            <option value="0" {{ $language->status == '0' ? 'selected' : '' }}>{{ __f('Status Pending Title') }}</option>
                        </x-form.selectbox>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6" >
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="default" type="checkbox" id="make-default" value="1" {{ $language->default == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="make-default">{{ __f('Make Default Title') }}</label>
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
        $(document).ready(function() {
            var projectRedirectUrl = "{{ route('admin.language.index') }}";
            $('#expenseForm').on('submit', function(e) {
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
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                alert(xhr.responseJSON.message);
                            } else {
                                alert('An unexpected error occurred.');
                            }
                        }
                    }

                });
            });
        });
    </script>
@endpush
