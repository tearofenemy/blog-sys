<table class="table table-bordered">
    <thead>
        <tr>
            <td width="150">Action</td>
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
                {!! Form::open(['method' => 'DELETE', 'route' => ['backend.blog.destroy', $post->id]]) !!}
                    <a href="{{ route('backend.blog.edit', $post->id) }}" class="btn btn-default">
                        Edit
                    </a>
                    <button type="submit" class="btn btn-danger">
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
                </abbr> |
                {!! $post->publicationLabel()  !!}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
