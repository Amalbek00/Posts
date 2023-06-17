@extends('layouts.app')

@section('content')
    <h1>{{ __('Edit Profile') }}</h1>

    @include('users.form', [
        'action' => route('users.update', ['user' => $user->id]),
        'method' => 'PUT'
    ])
@endsection
