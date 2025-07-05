@extends('layouts.app')
@section('title', $title)
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Switch to language translation Title') }}</h3>
            </div>
            <div class="card-body">
                <ul class="d-flex ps-0">
                    @foreach ($languages as $language)
                    <li class="me-3"><a href="{{ route('admin.language.website.translate',['lang' => $language->code] ) }}">
                        @if ($lang == $language->code)
                            <i class="fas fa-eye"></i>
                        @else
                            <i class="fas fa-edit"></i>
                        @endif
                        {{ $language->name }}</a></li>
                    @endforeach
                </ul>
                <div class="language-mode">
                    {{ __f('Your Editing Mode Title') }} : {{ $editlanguage->name ?? '' }}
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Website Translate Form Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="websiteTranslate" action="{{ route('admin.language.website.translate.store',['lang' => $lang] ) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @forelse($translations as $key => $value)
                        <div class="row mb-3">
                            <div class="col-12 col-md-12">
                                <x-form.textbox labelName="{{ $key }}" type="text" required="required" name="translations[{{ $key }}]" errorName="translations[{{ $key }}]"
                                    class="py-2" placeholder="Enter Your {{ $key }}" value="{{ $value }}">
                                </x-form.textbox>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    <div class="d-flex justify-content-end align-items-center mt-2">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none" role="status">
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
            $('#websiteTranslate').on('submit', function(e) {
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
                                window.location.reload();
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
