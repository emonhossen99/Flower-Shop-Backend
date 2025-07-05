@extends('emailtemplate::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('emailtemplate.name') !!}</p>
@endsection
