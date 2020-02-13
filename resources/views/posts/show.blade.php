@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="user-profile-img w-100 text-center mb-2">
                <img class="rounded-circle" src="{{ $post->user->profile->profileImage() }}" alt="">
            </div>
            <div class="caption text-center">
                <h5>
                    <a href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a>
                    <a class="btn-sm mr-5 bg-primary text-light">Follow</a>
                </h5>
                <h6>{{ $post->caption }}</h6>
            </div>
        </div>
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" alt="" class="w-100">
        </div>
    </div>
</div>
@endsection
