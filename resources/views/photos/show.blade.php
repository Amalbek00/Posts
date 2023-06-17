@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Photo detail') }}:
        </div>
        <img width="500"
             @if ($photo->picture)
                 src="{{asset('/storage/' . $photo->picture)}}" alt="{{$photo->picture}}"
             @else
                 src = "https://placehold.co/600x400/png" alt=""
            @endif
        >
        <h2 style="margin-left: 200px; color: #8b91a0" >{{ __('Average score') }}: {{ $photo->averageRating() }}</h2>

        <div class="card-body">
            <h2 class="card-title">{{$photo->title}}</h2>
            <p class="card-text">
                {{$photo->user->name}}
            </p>
            <footer class="footer">
            </footer>
            <a href="{{route('photos.index')}}" class="btn btn-outline-primary">{{ __('back') }}</a>
            <div class="row">
                <div class="col-md-12" style="padding-top: 30px">
                    <h3>{{ __('Comments') }}</h3>
                </div>
            </div>
            <div class="col-md-4 scrollit">
                @foreach($photo->comments as $comment)
                    @include('comments.show')
                @endforeach
            </div>
            @if(auth()->user())
                <div class="row">
                    <div class="col-md-12">
                        <div class="comment-form">
                            <form id="create-comment" method="post"
                                  action="{{route('photos.comments.store', ['photo' => $photo])}}">
                                @csrf
                                <div class="form-group">
                                    <label for="commentFormControl">{{ __('Comment') }}</label>
                                    <textarea name="body" class="form-control" id="commentFormControl" rows="3"
                                              required></textarea>
                                </div>
                                <div class="col-md-1">
                                <div class="form-group">
                                    <label for="score">{{ __('Rating') }}</label>
                                    <select name="score" class="form-control" id="score" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                </div>
                                <button id="create-comment-btn" type="submit" style="margin-top: 10px"
                                        class="btn btn-outline-primary btn-sm btn-block">{{ __('Add new comment') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
