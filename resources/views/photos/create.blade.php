@extends('layouts.app')

@section('content')
    <h1>{{ __('Add Photo') }}</h1>

    @include('photos.form', ['action' => route('photos.store')])
@endsection
