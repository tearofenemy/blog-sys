<article class="post-comments">
    <h3><i class="fa fa-comments"></i> {{ $post->comments()->count() }} Comments</h3>
        <div class="comment-body padding-10">
            <ul class="comments-list" id="post-comments">
                @foreach ($comments as $comment)
                    <li class="comment-item">
                        <div class="comment-heading clearfix">
                            <div class="comment-author-meta">
                                <h4>{{ $comment->author_name }} <small> {{ $comment->date }}</small></h4>
                            </div>
                        </div>
                        <div class="comment-content">
                            {!! $comment->body_html !!}
                        </div>
                    </li>
                @endforeach
            </ul>
            <nav>
                {{ $comments->links() }}
            </nav>
        </div>

        <div class="comment-footer padding-10">
            <h3>Leave a comment</h3>
            @if (session('s_message'))
                <div class="alert alert-info">
                    {{ session('s_message') }}
                </div>
            @endif
            {!! Form::open(['route' => ['blog.comments', $post->slug]]) !!}
            <form>
                <div class="form-group required {{ $errors->has('author_name') ? 'has-error' : ''}}">
                    <label for="name">Name</label>
                    {!! Form::text('author_name', null, ['class' => 'form-control', 'placeholder' => 'Input name']); !!}
                    @if ($errors->has('author_name'))
                        <span class="help-block">{{ $errors->first('author_name') }}</span>
                    @endif
                </div>
                <div class="form-group required {{ $errors->has('author_email') ? 'has-error' : ''}}">
                    <label for="email">Email</label>
                    {!! Form::text('author_email', null, ['class' => 'form-control', 'placeholder' => 'Input email']) !!}
                    @if ($errors->has('author_email'))
                        <span class="help-block">{{ $errors->first('author_email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    {!! Form::text('author_url', null, ['class' => 'form-control', 'placeholder' => 'Input site']) !!}
                </div>
                <div class="form-group required {{ $errors->has('body') ? 'has-error' : ''}}">
                    <label for="comment">Comment</label>
                    {!! Form::textarea('body', null, ['rows' => 6, 'class' => 'form-control', 'placeholder' => 'Input comment']) !!}
                    @if ($errors->has('body'))
                        <span class="help-block">{{ $errors->first('body') }}</span>
                    @endif
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </div>
                    <div class="pull-right">
                        <p class="text-muted">
                            <span class="required">*</span>
                            <em>Indicates required fields</em>
                        </p>
                    </div>
                </div>
            </form>
            {!! Form::close() !!}
        </div>
</article>
