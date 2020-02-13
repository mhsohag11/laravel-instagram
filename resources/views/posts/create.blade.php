@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-8 offset-2">
        <form action="/p" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="row">
                    <label for="caption" class="col-form-label">{{ __('Caption') }}</label>

                    <input id="caption"
                           type="text"
                           class="form-control @error('caption') is-invalid @enderror"
                           name="caption"
                           value="{{ old('caption') }}"
                           autocomplete="caption" autofocus>

                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 row col-form-label">Post Image</label>
                    <input type="file" name="image" id="image" class="form-control-file">

                    @error('image')
                    <span role="alert" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">Add new Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
