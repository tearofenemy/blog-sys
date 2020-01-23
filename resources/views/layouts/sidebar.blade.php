<div class="col-md-4">
    <aside class="right-sidebar">
        <div class="search-widget">
            <form action="{{ route('home') }}">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" value="{{ request('query') }}" name="query" placeholder="Search">
                    <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div>
            </form>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach ($categories as $category)
                        <li>
                            <i class="fa fa-angle-right"></i><a href="{{ route('category', $category) }}"> {{ $category->title }}</a>
                            <span class="badge pull-right">{{ $category->posts->count() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach ($popularPosts as $p_post)
                        <li>
                        @if ($p_post->img_thumb_url)
                            <div class="post-image">
                            <a href="{{ route('show', $p_post->slug) }}">
                                <img src="{{ $p_post->img_thumb_url }}">
                            </a>
                        </div>
                        @endif
                        <div class="post-body">
                            <h6><a href="{{ route('show', $p_post->slug) }}">{{ $p_post->slug}}</a></h6>
                            <div class="post-meta">
                                <span>{{ $p_post->date_for_popular }}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    @foreach ($tags as $tag)
                        <li><a href="{{ route('tag', $tag->slug) }}">{{ $tag->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="widget">
            <div class="widget-heading">
                <h4>Archive</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach ($archives as $archive)
                        <li>
                            <a href="{{ route('home', ['month' => $archive->month, 'year' => $archive->year]) }}">{{ $archive->month .' '. $archive->year}}</a>
                            <span class="badge pull-right">{{ $archive->total_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>
