@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="user-logo">
                <img src="{{ $user->profile->profileImage() }}" alt="">
            </div>
        </div>
        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>

                @can('update', $user->profile)
                    <a href="/p/create" class="btn-primary btn-sm">Add new post</a>
                @endcan
            </div>
            @if($user->id != auth()->id())
            <follow-button user-id="{{ $user->id }}" following-status="{{ $followingStatus }}"></follow-button>
            @endif
            @can('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit" class="btn-primary btn-sm">Edit Profile</a>
            @endcan

            <count-value followers="{{ $user->profile->followers->count() }}" posts="{{ $user->posts->count() }}" following="{{ $user->following->count() }}"></count-value>

            <div class="user-website font-weight-bold pt-10">
                {{ $user->profile->title ?? '' }}
            </div>
            <div class="user-short-info">
                {{ $user->profile->description ?? '' }}
                <br>
                <strong>{{ $user->profile->url ?? 'N/A' }}</strong>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        @foreach($user->posts as $post)
        <div class="col-4">
            <div class="single-img">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" alt="" class="w-100">
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
