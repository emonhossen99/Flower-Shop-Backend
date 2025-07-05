@extends('image::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('image.name') !!}</p>
@endsection
