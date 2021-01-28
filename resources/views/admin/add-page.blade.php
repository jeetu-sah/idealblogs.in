@extends('admin.layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
              <li class="breadcrumb-item active">Add Post </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Post</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                      @if(Session::has('msg'))
                        {!!  Session::get("msg") !!}
                      @endif
                        <form action="<?php echo route("admin.savePage") ?>" method="post">
                                    @csrf
                                        <div class="form-group">
                                            <label>Select Parent page </label>
                                              <select class="form-control" name="parent_id" id="">
                                                <option value="">Select parent page</option>
                                                 {!! $pageList !!}
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <input type="text" name="page_name" id="page_name" class="form-control" required="required" placeholder="Page Name" value="{{ old('page_name') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="5" placeholder="Post Description" name="meta_description" >{{ old('meta_description') }}</textarea>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                         
                  
            </form>
                </div>
            </div>
        </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@stop
