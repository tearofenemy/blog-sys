<table class="table table-bordered">
    <thead>
        <tr>
            <td width="150">Action</td>
            <td>Name</td>
            <td>Slug</td>
            <td>Posts</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['backend.category.destroy', $category->id]]) !!}
                        <a href="{{ route('backend.category.edit', $category->id) }}" class="btn btn-default">
                            Edit
                        </a>
                        @if ($category->id == config('cms.default_category_id'))
                            <button onclick="return false;" type="submit" class="btn btn-danger disabled">
                                Delete
                            </button>
                        @else
                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">
                            Delete
                        </button>
                        @endif
                    {!! Form::close() !!}
                </td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->posts->count() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
