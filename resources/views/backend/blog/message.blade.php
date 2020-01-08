@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
        <div class="pull-right">
            <i class="fa fa-close" id="close_session_msg"></i>
        </div>
    </div>
@elseif (session('trash-msg'))
    <?php list($message, $postId) = session('trash-msg'); ?>
    {!! Form::open(['method' => 'PUT', 'route' => ['backend.blog.restore', $postId]]) !!}
        <div class="alert alert-info">
            {{ $message }}
            <button type="submit" class="btn btn-warning"><i class="fa fa-undo"></i> Undo</button>
            <div class="pull-right">
                <i class="fa fa-close" id="close_session_msg"></i>
            </div>
        </div>
    {!! Form::close() !!}
@endif
