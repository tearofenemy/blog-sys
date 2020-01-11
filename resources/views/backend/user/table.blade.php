<table class="table table-bordered">
    <thead>
        <tr>
            <td width="150">Action</td>
            <td>Name</td>
            <td>Email</td>
            <td>Posts</td>
            <td>Role</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <a href="{{ route('backend.user.edit', $user->id) }}" class="btn btn-default">
                        Edit
                    </a>
                    @if (($user->id == config('cms.default_user_id')) || ($user->id == auth()->user()->id))
                        <button type="submit" onclick="return false;" class="btn btn-danger disabled">
                            Delete
                        </button>
                    @else
                        <a href="{{ route('backend.user.confirm', $user->id) }}" class="btn btn-danger">
                            Delete
                        </a>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->posts()->count() }}</td>
                <td>--</td>
            </tr>
        @endforeach
    </tbody>
</table>
