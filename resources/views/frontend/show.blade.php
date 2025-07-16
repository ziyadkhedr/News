@extends('layouts.frontend.app')
@section('title')
    Show, {{ $mainpost->title }}
@endsection
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a
            href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a></li>
    <li class="breadcrumb-item active">{{ $mainpost->title }}</li>


@endsection
@section('body')


    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainpost->images as $item)


                                <div class="carousel-item @if($loop->index == 0) active @endif">
                                    <img src="{{ asset($item->path) }}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{!! $mainpost->title !!}</h5>
                                        <p>
                                            {{-- {!! substr($mainpost->description, 0, 80)!!} --}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="sn-content">
                        {!! $mainpost->description!!}
                    </div>


                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        @if(auth()->check())
                            @if ($mainpost->comment_able == true)
                                <form action="" id='commentForm'>
                                    @csrf
                                    <div class="comment-input">
                                        <input name="comment" type="text" placeholder="Add a comment..." id="commentBox" />

                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                        <input type="hidden" name="post_id" value="{{ $mainpost->id }}">
                                        <button type="submit" id="addCommentBtn">Comment</button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-info">unable to comment</div>
                            @endif
                        @else
                            <div class="alert alert-warning">You have to login to write a Comment.</div>
                        @endif
                        <div id="errorMsg" class="alert alert-danger" style="display: none;">
                            {{-- display error --}}
                        </div>
                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach ($mainpost->comments as $comment)

                                <div class="comment">
                                    <img src="{{ $comment->user->image }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{ $comment->user->name }}</span>
                                        <p class="comment-text">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- Add more comments here for demonstration -->

                        <!-- Show More Button -->
                        @if ($mainpost->comments->count() > 2)
                            <button id="showMoreBtn" class="show-more-btn">Show more</button>

                        @endif
                        <button id="showLessBtn" class="show-more-btn" style="display: none;">Show Less</button>

                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($latest_posts as $post)


                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ $post->images->first()->path }}" class="img-fluid"
                                            alt="{{ $post->title }}" />
                                        <div class="sn-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                title="{{ $post->title }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($posts_belonges_to_category as $post)


                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ $post->images->first()->path }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    {{-- popular --}}
                                    <div id="popular" class="container tab-pane active">
                                        @foreach ($top_posts_comments as $post)


                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $post->images->first()->path }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title='{{ $post->title }}'>{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- latest --}}
                                    <div id="latest" class="container tab-pane fade">
                                        @foreach ($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $post->images->first()->path }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}t</a>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- news category --}}
                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)

                                        <li><a
                                                href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a><span>({{ $category->posts()->count() }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection

@push('js')
    <script>
        //show more comments
        $(document).on('click', '#showMoreBtn', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.post.getallposts', $mainpost->slug) }}",
                type: 'GET',
                success: function ($data) {
                    $('.comments').empty();
                    $.each($data, function (key, comment) {
                        $('.comments').append(` <div class="comment">
                                                                                                                                                                                                                                <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                                                                                                                                                                                                                <div class="comment-content">
                                                                                                                                                                                                                                    <span class="username">${comment.user.name}</span>
                                                                                                                                                                                                                                    <p class="comment-text"> ${comment.comment} </p>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                            </div>`)

                        $('#showMoreBtn').hide();
                        $('#showLessBtn').show();

                    });
                },
                error: function ($data) {

                },
            });

        });
        // زر Show Less
        $(document).on('click', '#showLessBtn', function (e) {
            e.preventDefault();
            $('.comments').empty(); // اخفاء كل الكومنتات
            ////////#
            let allComments = @json($mainpost->comments); // إرسال بيانات التعليقات من السيرفر لجافاسكريبت
            let visibleLimit = 3;

            function renderComments(limit) {
                $('.comments').empty();

                let visibleComments = allComments.slice(0, limit);

                $.each(visibleComments, function (index, comment) {
                    $('.comments').append(`
                                                                                                                                                                                                                                            <div class="comment">
                                                                                                                                                                                                                                                <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                                                                                                                                                                                                                                <div class="comment-content">
                                                                                                                                                                                                                                                    <span class="username">${comment.user.name}</span>
                                                                                                                                                                                                                                                    <p class="comment-text">${comment.comment}</p>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                        `);
                });
            }

            // عند تحميل الصفحة
            $(document).ready(function () {
                renderComments(visibleLimit);

                if (allComments.length > visibleLimit) {
                    $('#showMoreBtn').show();
                }
            });

            $('#showMoreBtn').on('click', function () {
                renderComments(allComments.length);
                $('#showMoreBtn').hide();
                $('#showLessBtn').show();
            });

            $('#showLessBtn').on('click', function () {
                renderComments(visibleLimit);
                $('#showLessBtn').hide();
                $('#showMoreBtn').show();
            });

            //////////////#

            $('#showMoreBtn').show(); // اظهار زر show more
            $(this).hide(); // اخفاء زر show less
        });

        //add comment
        $(document).on('submit', '#commentForm', function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({

                url: "{{ route('frontend.post.comments.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function (data) {
                    $('#errorMsg').hide();
                    $('.comments').prepend(`<div class="comment">
                                                                                                                                                                                    <img src="${data.comment.user.image}" alt="User Image" class="comment-img" />
                                                                                                                                                                                    <div class="comment-content">
                                                                                                                                                                                        <span class="username">${data.comment.user.name}</span>
                                                                                                                                                                                        <p class="comment-text">${data.comment.comment}</p>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>`);
                    // تفريغ الفورم
                    $('#commentForm')[0].reset();
                },
                error: function (data) {
                    var response = $.parseJSON(data.responseText);
                    $('#errorMsg').text(response.errors.comment).show();
                },


            });
        });

    </script>
@endpush