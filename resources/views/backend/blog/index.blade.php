@extends('layouts.backend.main')

@section('title', "My Blog | Index")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Blog <small>Display All Posts</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
        <li>All Posts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('backend.blog.create') }}" class="btn btn-success">Add New</a>
                    </div>
                </div>
              <!-- /.box-header -->
              <div class="box-body">

                    @include('backend.blog.message')

                    @if (!$posts->count())
                        <div class="alert alert-danger">
                            <strong>No found records</strong>
                        </div>
                    @else
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
                        @endif
                        </tbody>
                    </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-left">
                    <ul class="pagination no-margin">
                       {{ $posts->links() }}
                    </ul>
                </div>
                <div class="pull-right">
                    <small>{{ $posts->count() }} items</small>
                </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection


@include('backend.blog.scripts')
