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
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                    {!! Form::model($post, [
                        'method' => 'POST',
                        'route' => 'backend.blog.store'
                    ]) !!}

                    <div class="form-group">
                        {!! Form::label('title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Input title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Input slug']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('excerpt') !!}
                        {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'placeholder' => 'Input excerpt']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('body') !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Input body']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('published_at', 'Publish Date') !!}
                        {!! Form::date('published_at', null, ['class' => 'form-control', 'placeholder' => 'Select publish date']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_id', 'Category') !!}
                        {!! Form::select('category_id', App\Category::pluck('title', 'id'), ['placeholder' => 'Select category']) !!}
                    </div>
                    <hr>

                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
    <script>
        $('ul.pagination').addClass('no-margin pagination-xs');
        $('select#category_id').addClass('form-control');
    </script>
@endsection
