@extends('layouts.backend.main')

@section('title', "My Blog | Create Post")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Blog <small>Create New Post</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
        <li>Create Post</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            {!! Form::model($post, [
                        'method' => 'POST',
                        'route' => 'backend.blog.store',
                        'files' => true,
                        'id' => 'post-form'
                    ]) !!}
                @include('backend.blog.form')
            {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@include('backend.blog.scripts')
