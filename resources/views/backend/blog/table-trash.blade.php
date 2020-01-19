 <table class="table table-bordered">
    <thead>
        <tr>
            <td width="170">Action</td>
            <td>Slug</td>
            <td>Author</td>
            <td>Category</td>
            <td width="160">Date</td>
        </tr>
    </thead>
    <tbody>
        <?php $request = request(); ?>
        @foreach ($posts as $post)
            <tr>
            <td>
                {!! Form::open(['method' => 'PUT', 'style' => 'display:inline-block;', 'route' => ['backend.blog.restore', $post->id]]) !!}
                    @if (check_user_permission($request, "Blog@restore", $post->id))
                        <button type="submit" class="btn btn-default">
                            Restore
                        </button>
                    @else
                        <button type="submit" onclick="return false;" class="btn btn-default disabled">
                            Restore
                        </button>
                    @endif
                {!! Form::close() !!}
                {!! Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'route' => ['backend.blog.force-destroy', $post->id]]) !!}
                    @if (check_user_permission($request, "Blog@forceDestroy", $post->id))
                        <button type="submit" onclick="return confirm('Your post will be delete. Are you shure your choise?')" class="btn btn-danger">
                            Delete
                        </button>
                    @else
                        <button type="submit" onclick="return false;" class="btn btn-danger disabled">
                            Delete
                        </button>
                    @endif
                {!! Form::close() !!}
            </td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}">
                    {{ $post->dateFormatted() }}
                </abbr>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
