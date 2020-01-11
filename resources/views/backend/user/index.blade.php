@extends('layouts.backend.main')

@section('title', "My Blog | User Index")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Users <small>Display All Users</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active"><a href="{{ route('backend.user.index') }}">User</a></li>
        <li>All Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('backend.user.create') }}" class="btn btn-success">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
              <div class="box-body">
                    @include('backend.partitials.message')

                    @if (!$usersCount)
                        <div class="alert alert-danger">
                            <strong>No found users</strong>
                        </div>
                    @endif
                    @include('backend.user.table')
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    <small>{{ $usersCount }} items</small>
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

@include('backend.user.scripts')
