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
                    <div class="pull-right" style="padding: 7px 0;">
                        <?php $links = []; ?>
                        @foreach ($statusList as $key => $value)
                            @if ($value)
                                <?php $selected = Request::get('status') == $key ? 'selected-link' : ''; ?>
                                <?php echo "<a class=\"{$selected}\" href=\"?status={$key}\">". $key ."({$value})</a> | "; ?>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- /.box-header -->
              <div class="box-body">
                    @include('backend.blog.message')

                    @if (!$postsCount)
                        <div class="alert alert-danger">
                            <strong>No found records</strong>
                        </div>
                    @else
                        @if ($onlyTrashed)
                            @include('backend.blog.table-trash')
                        @else
                            @include('backend.blog.table')
                        @endif
                    @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-left">
                    <ul class="pagination no-margin">
                       {{ $posts->appends(Request::query())->render() }}
                    </ul>
                </div>
                <div class="pull-right">
                    <small>{{ $postsCount }} items</small>
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
