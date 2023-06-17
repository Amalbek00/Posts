@extends('layouts.app')

@section('content')
    <div style="display: flex; align-items: center;">
        <h1 style="margin-left: 10px;">
            {{$user->name}} | {{ __('Profile') }}
        @if(auth()->user()?->email === $user->email)<a href="{{route('users.edit', ['user' => Auth::user()])}}" type="button" class="btn btn-outline-primary">
               {{ __('Edit Profile') }}
            </a>
            @endif
        </h1>
    </div>
    <div  style="padding-top: 20px; display: flex; align-items: center">
        @if(auth()->user()?->email === $user->email) <h4>{{ __('My Photos') }}:</h4>
        <a href="{{route('photos.create')}}" type="button" class="btn btn-outline-primary" style="width: 300px; margin-left: 20px">
            {{ __('Add Photo') }}
        </a>
        @endif
    </div>
    <table class="table" style="padding-top: 30px">
        <thead class="thead-dark">
        <tr>
            <th scope="col">{{ __('Photo') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($photos as $photo)
            <tr>
                <td>
                    <img width="200"
                         @if ($photo->picture)
                             src="{{asset('/storage/' . $photo->picture)}}" alt="{{$photo->picture}}"
                         @else
                             src="" alt=""
                        @endif
                    >
                </td>
                <td>
                    {{$photo->title}}
                </td>
                <td>
                    @if(auth()->user()?->email === $user->email)
                        <form method="post" action="{{route('photos.destroy', ['photo' => $photo])}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">{{ __('Delete') }}</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row justify-content-md-center p-5">
        <div class="col-md-auto">
            {{ $photos->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
