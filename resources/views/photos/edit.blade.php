@extends('layouts.app')

@section('content')
    <h1>{{ __('Edit Photo') }}</h1>

    @include('photos.form', [
        'action' => route('photos.update', ['photo' => $photo->id]),
        'method' => 'PUT'
    ])
@endsection
