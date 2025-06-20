@extends('layouts.frontend.app')
@section('title')
    Search
@endsection
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active">search
    </li>
@endsection
@section('body')
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @if($message)
                            <div class="alert alert-warning text-center w-50">{{ $message }}</div>
                        @endif
                        @foreach ($posts as $post)

                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}" />
                                    {{-- @if ($post->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $post->images->first()->path) }}" />
                                    @endif --}}

                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
    <!-- Main News End-->

@endsection