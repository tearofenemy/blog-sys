@extends('layouts.backend.main')

@section('title', "My Blog | Edit Account")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Blog <small>Edit Account</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li>Edit Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('backend.partitials.message')
            {!! Form::model($user, [
                        'method' => 'PUT',
                        'route' => 'edit-account',
                        'files' => true,
                        'id' => 'user-form'
                    ]) !!}
                @include('backend.user.form', ['hiddenRoleDropDown' => true])
            {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
