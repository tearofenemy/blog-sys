@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($post)
                    <article class="post-item post-detail">
                        @if ($post->img_url)
                            <div class="post-item-image">
                                <img src="{{ $post->img_url }}" alt="">
                            </div>
                        @endif
                        <div class="post-item-body">
                            <div class="padding-10">
                                <h1>{{ $post->slug }}</h1>

                                <div class="post-meta no-border">
                                    <ul class="post-meta-group">
                                        <li><i class="fa fa-user"></i><a href="{{ route('author', $post->author->slug) }}"> {{ $post->author->name }}</a></li>
                                        <li><i class="fa fa-clock-o"></i><time> {{ $post->date }}</time></li>
                                        <li><i class="fa fa-folder"></i><a href="{{ route('category', $post->category) }}"> {{ $post->category->title }}</a></li>
                                        <li><i class="fa fa-tags"></i>{!! $post->tags_html !!}</li>
                                        <li><i class="fa fa-comments"></i><a href="#">{{ $post->comments->count() }} Comments</a></li>
                                        <li><i class="fa fa-eye"></i> {{ $post->view_count }}</li>
                                    </ul>
                                </div>

                                {!! $post->body_html !!}
                            </div>
                        </div>
                    </article>

                    <article class="post-author padding-10">
                        <div class="media">
                        <div class="media-left">
                            <?php $author = $post->author; ?>
                            <a href="{{ route('author', $author->slug) }}">
                                <img alt="{{ $author->name }}" src="/img/author.jpg" class="media-object">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ route('author', $author->slug) }}">{{ $author->name }}</a></h4>
                            <div class="post-author-count">
                            <a href="#">
                                <?php $postCount = $author->posts()->published()->count(); ?>
                                <i class="fa fa-clone"></i>
                                {{ $postCount }} posts
                            </a>
                            </div>
                            <p>{!! $author->bio_html !!}</p>
                        </div>
                        </div>
                    </article>
                @endif
                @include('blog.comments')
                <!-- comments here -->
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection



