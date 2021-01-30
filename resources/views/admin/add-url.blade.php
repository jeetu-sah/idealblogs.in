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
                <h3 class="card-title">Add Page Url</h3>
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
                     @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <form action="<?php echo route("seoManagement.saveUrl") ?>" method="post" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label>Url </label>
                        <input type="text" name="url" id="url" class="form-control" required="required" placeholder="Url" value="{{ old('url') }}" />
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" required="required" placeholder="Title" value="{{ old('title') }}" />
                    </div>
                <div class="form-group">
                    <label>Meta Keyword</label>
                    <textarea class="form-control" rows="5" placeholder="Meta Keyword" name="meta_keyword" >{{ old('meta_keyword') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Meta description</label>
                    <textarea class="form-control" rows="5" placeholder="Meta Description" name="meta_description" >{{ old('meta_description') }}</textarea>
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
