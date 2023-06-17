<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @method($method ?? 'POST')
    @csrf
    <div class="form-group">
        <label for="title">{{ __('Title') }}</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
               value="{{isset($photo) ? $photo->title : old('title')}}">
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <br><div class="form-group mb-1">
        <div class="custom-file">
            <img
                @if(isset($photo, $photo->picture))
                    src="{{asset('/storage/' . $photo->picture)}}" alt="{{$photo->picture}}"
                @else
                    src = "https://placehold.co/600x400/png" alt=""
                @endif
                style="max-width:100px;max-height:100px;" class="mb-1" id="picturePreview">
            <input type="file" class="form-control form-control-sm @error('picture') is-invalid @enderror"
                   value="{{ old('picture') }}"
                   id="customFile"
                   name="picture" value="{{isset($photo, $photo->picture) ? $photo->picture : ''}}"
                   onchange="preview()"
            >
            @error('picture')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
            <button onclick="clearImage()" class="btn btn-danger mt-3">{{ __('Clear') }}</button>
        </div>
    </div>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="form-group mb-1">
    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
    </div>
</form>
@section('script')
    <script>
        function preview() {
            picturePreview.src = URL.createObjectURL(event.currentTarget.files[0]);
        }
            function clearImage() {
                event.preventDefault();
                customFile.value = null;
                picturePreview.src = '';
                picturePreview.alt = '';
            }
    </script>
@endsection
