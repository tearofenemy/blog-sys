@extends('layouts.backend.main')

@section('title', "My Blog | Edit User")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Blog <small>Edit User</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><a href="{{ route('backend.user.index') }}">User</a></li>
        <li>Edit User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            {!! Form::model($user, [
                        'method' => 'PUT',
                        'route' => ['backend.user.update', $user->id],
                        'id' => 'user-form'
                    ]) !!}
                @include('backend.user.form')
            {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
