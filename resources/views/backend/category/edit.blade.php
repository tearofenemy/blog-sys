@extends('layouts.backend.main')

@section('title', "My Blog | Edit Category")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Blog <small>Edit Category</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><a href="{{ route('backend.category.index') }}">Category</a></li>
        <li>Edit Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            {!! Form::model($category, [
                        'method' => 'PUT',
                        'route' => ['backend.category.update', $category->id],
                        'id' => 'post-form'
                    ]) !!}
                @include('backend.category.form')
            {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@include('backend.category.scripts')
