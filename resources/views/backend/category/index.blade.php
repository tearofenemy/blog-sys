@extends('layouts.backend.main')

@section('title', "My Blog | Category Index")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Category <small>Display All Categories</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><a href="{{ route('backend.category.index') }}">Category</a></li>
        <li>All Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('backend.category.create') }}" class="btn btn-success">Add New</a>
                    </div>
                    <div class="pull-right" style="padding: 7px 0;">

                    </div>
                </div>
                <!-- /.box-header -->
              <div class="box-body">
                    @include('backend.partitials.message')

                    @if (!$categoriesCount)
                        <div class="alert alert-danger">
                            <strong>No found categories</strong>
                        </div>
                    @endif
                    @include('backend.category.table')
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    <small>{{ $categoriesCount }} items</small>
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


@include('backend.category.scripts')
