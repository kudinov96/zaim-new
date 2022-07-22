@extends('front.layout.base')

@section("content")
    <div class="content-style">
        <h1>{{ $post->title }}</h1>
        {!! $post->content !!}
    </div>
@endsection
