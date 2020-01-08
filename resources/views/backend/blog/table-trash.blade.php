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
        @foreach ($posts as $post)
            <tr>
            <td>
                {!! Form::open(['style' => 'display:inline-block;', 'method' => 'PUT', 'route' => ['backend.blog.restore', $post->id]]) !!}
                    <button type="submit" class="btn btn-default">
                        Restore
                    </button>
                {!! Form::close() !!}
                {!! Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'route' => ['backend.blog.force-destroy', $post->id]]) !!}
                    <button type="submit" onclick="return confirm('Your post will be delete. Are you shure your choise?')" class="btn btn-danger">
                        Delete
                    </button>
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
