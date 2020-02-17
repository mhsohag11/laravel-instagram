@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($posts as $post)
            <div class="col-6 mb-4">
                <div class="post-heading">
                    <h3><a href="/profile/{{ $post->user->id }}">{{ $post->user->name ?? $post->user->username }}</a></h3>
                </div>
                <a href="/profile/{{ $post->user->id }}"><img src="/storage/{{ $post->image }}" alt="" class="w-100"></a>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
