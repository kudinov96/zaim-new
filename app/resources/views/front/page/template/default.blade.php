@extends('front.layout.base')

@section("content")
    @if($post->pages)
        <ul class="page-children">
            @foreach($post->pages as $page)
                <li>
                    <a href="/{{ $page->slug_full }}">{{ $page->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="content-style">
        <h1>{{ $post->title }}</h1>
        {!! $post->content !!}
    </div>
@endsection
