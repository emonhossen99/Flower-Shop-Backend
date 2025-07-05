<div class="form-group {{ $parantClass ?? '' }}">
    <label class="d-block form-label {{ $required ?? '' }}" for="{{ $name }}">{{ $labelName ?? '' }} @if(!empty($optionalText)) <span class="label-optional">{{ $optionalText }}</span> @endif</label>
    <textarea class="form-control {{ $class ?? '' }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}" rows="{{ $rows ?? '4' }}">{!! $value ?? '' !!}</textarea>
    @if (!empty($inputText))<span class="input-optional w-100">{!! $inputText !!}</span>@endif
    <span class="text-danger error-text {{ $name }}-error"></span>
</div>
