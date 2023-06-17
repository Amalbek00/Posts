<div class="container">
    <div class="comment" style="padding-top: 20px">
        <div class="media g-mb-30 media-comment">
            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30 d-flex justify-content-between align-items-center">
                <div class="g-mb-15">
                    <h5 class="h5 g-color-gray-dark-v1 mb-0">{{$comment->user?->name ?: "Some user"}}</h5>
                    <div>{{ __('Rating') }}: <strong>{{$comment->score}}</strong></div>
                    <p>                        {{$comment->body}}
                    </p>
                    <span class="g-font-size-5" style="color: gray">{{$comment->created_at?->diffForHumans()}}</span>
                </div>
                <div>
                    @can('delete', $comment)
                        <form id="delete" action="{{ route('photos.comments.destroy', ['photo' => $comment->photo, 'comment' => $comment]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" type="submit">{{ __('Delete') }}</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <hr class="border-bottom">
</div>
