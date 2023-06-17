@extends('layouts.app')

@section('content')

    <div style="padding-bottom: 30px;">
        <h1>{{ __('All Photos') }}</h1>
    </div>
    <div class="row">
        @foreach($photos as $photo)
            <div class="col-md-3" style="padding-bottom: 30px">
                <div class="card">
                    <img class="card-img-top" style="max-height: 700px; object-fit: cover;"
                         @if ($photo->picture)
                             src="{{asset('/storage/' . $photo->picture)}}" alt="{{$photo->picture}}"
                         @else
                             src = "https://placehold.co/600x400/png" alt=""
                        @endif
                    >
                    <div class="card-body">
                        <a href="{{route('photos.show', ['photo' => $photo])}}"><h5
                                class="card-title">{{$photo->title}}</h5></a>
                        <p class="card-text">
                        <div style="color: gray; font-size: 12px">{{$photo->created_at}}</div>
                        </p>
                    </div>
                    <div class="card-footer">
                        {{ __('By') }}: <a href="{{route('users.show' , ['user' => $photo->user])}}">{{$photo->user->name}}</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row justify-content-md-center p-5">
            <div class="col-md-auto">
                {{ $photos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
