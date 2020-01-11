@extends('layouts.backend.main')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <h1>User <small>confrim to deletion</small>   </h1>
        <div class="row">
            {!! Form::model($user, [
                        'method' => 'DELETE',
                        'route' => ['backend.user.destroy', $user->id],
            ])!!}
            <div class="col-xs-9">
                <div class="box">
                    <div class="box-body">
                        <p>
                            You have specified this user for deletion:
                        </p>
                        <p>
                            ID #{{ $user->id }}: {{ $user->name }}
                        </p>
                        <p>
                            What should be done with content of this user?
                        </p>
                        <p>
                            <input type="radio" name="deleted_option" value="delete">Delete all content
                        </p>
                        <p>
                            <input type="radio" name="deleted_option" value="attribute">Attribute content to:
                            {!! Form::select('selected_user', $users, null) !!}
                        </p>
                    </div>
                    <div class="box-footer">
                        <div class="pull-left">
                            <button type="submit" class="btn btn-danger">Confrim Deletion</button>
                            <a href="{{ route('backend.user.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
