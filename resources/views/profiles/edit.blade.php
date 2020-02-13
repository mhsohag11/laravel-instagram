@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <div class="row">
                        <label for="title" class="col-form-label">{{ __('Profile Title') }}</label>

                        <input id="title"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               value="{{ old('title') ?? $user->profile->title ?? '' }}"
                               autocomplete="title" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <label for="description" class="col-form-label">{{ __('Profile Description') }}</label>

                        <input id="description"
                               type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description"
                               value="{{ old('description') ?? $user->profile->description ?? '' }}"
                               autocomplete="description" autofocus>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <label for="url" class="col-form-label">{{ __('Url') }}</label>

                        <input id="url"
                               type="text"
                               class="form-control @error('url') is-invalid @enderror"
                               name="url"
                               value="{{ old('url') ?? $user->profile->url ?? '' }}"
                               autocomplete="url" autofocus>

                        @error('url')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <label for="image" class="col-md-4 row col-form-label">Profile Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">

                        @error('image')
                        <span role="alert" style="color: red;">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="row pt-4">
                        <button class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
