@extends('layouts.main')

@section('content')
   <div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (!$posts->count())
                <div class="alert alert-warning">
                    Nothing have
                </div>
            @else
                @include('blog.alert')
                @foreach ($posts as $post)
                    <article class="post-item">
                        @if($post->img_url)
                            <div class="post-item-image">
                                <a href="{{ route('show', $post) }}">
                                    <img src="{{ $post->img_url }}">
                                </a>
                            </div>
                        @endif
                        <div class="post-item-body">
                            <div class="padding-10">
                                <h2><a href="{{ route('show', $post) }}">{{ $post->slug }}</a></h2>
                                <p>{{ $post->excerpt }}</p>
                            </div>
                            <div class="post-meta padding-10 clearfix">
                                <div class="pull-left">
                                    <ul class="post-meta-group">
                                        <li><i class="fa fa-user"></i><a href="{{ route('author', $post->author->slug) }}">{{ $post->author->name }}</a></li>
                                        <li><i class="fa fa-clock-o"></i><time>{{ $post->date}}</time></li>
                                        <li><i class="fa fa-folder"></i><a href="{{ route('category', $post->category) }}"> {{ $post->category->title }}</a></li>
                                        <li><i class="fa fa-eye"></i> {{ $post->view_count }}</li>
                                        <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('show', $post) }}">More &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

            @endif

            <nav>
                {{ $posts->appends(request()->only(['query']))->links() }}
            </nav>
        </div>
        @include('layouts.sidebar')
    </div>
</div>
@endsection

