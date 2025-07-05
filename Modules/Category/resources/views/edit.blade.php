@extends('layouts.app')
@section('title',$title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-style.css') }}">
    <style>
        #category_image_dimensions{
            font-size: 11px;
            color: #ff6000c9;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Category Edit Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="categoryEditForm" action="{{ route('admin.category.updates', ['id' => $category->id]) }}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="update_id" value="{{ $category->id }}">
                        <x-form.textbox labelName="{{ __f('Category Name Label Title') }}" parantClass="col-12 col-md-6" name="name"
                            required="required" placeholder="{{ __f('Category Name Placeholder Title') }}" errorName="name" class="py-2"
                            value="{!! $category->name ?? old('name') !!}"></x-form.textbox>

                            <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="status"
                            required="required" labelName="{{ __f('Status Label Title') }}" errorName="status">
                            <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>{{ __f('Status Publish Title') }}</option>
                            <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>{{ __f('Status Pending Title') }}</option>
                        </x-form.selectbox>
                    </div>
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Order By Label Title') }}" parantClass="col-12 col-md-6" name="order_by"
                            required="required" placeholder="{{ __f('Order By Label Title') }}" errorName="order_by" class="py-2"
                            value="{{ $category->order_by ?? old('order_by') }}"></x-form.textbox>
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
            var projectRedirectUrl = "{{ route('admin.category.index') }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#categoryEditForm').on('submit', function(e) {
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

            $('#parent_id').on('change',function(){
                var categoryId = $(this).val();
                $.ajax({
                    url: "{{ route('admin.category.sub.menu') }}",
                    method: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        categoryId: categoryId,
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#submenu_id').html('');
                            $('#submenu_id').html(res.data);
                        }
                    },
                    error: function(xhr) {
                        console.log('Something went wrong. Please try again.');
                    }
                });
            })
        });
    </script>
@endpush
