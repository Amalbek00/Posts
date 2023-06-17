<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @method($method ?? 'POST')
    @csrf
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
               value="{{isset($user) ? $user->name : old('name')}}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
    <input type="hidden" name="password" value="{{ Auth::user()->password }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="form-group mb-1">
    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
