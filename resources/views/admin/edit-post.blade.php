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
              <li class="breadcrumb-item active">Edit Post </li>
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
                <h3 class="card-title">Edit Post</h3>
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
                  <form action="{{route("admin.editPost")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Image</label>
                            <input type="hidden" name="editid" id="editid" class="form-control" value="<?php if(!empty($post->id))echo $post->id; ?>"  />
                            <input type="hidden" name="pageid" id="pageid" class="form-control" value="<?php if(!empty($post->pages_id))echo $post->pages_id; ?>"  />
                            <input type="file" name="image" id="image" class="form-control"  placeholder="Title"  />
                            <input type="hidden" name="image_old" id="image_old" value="@if(!empty($post->image)){{  $post->image }} @endif">
                        </div>
                        <div class="form-group">
                            <label>Select page </label>
                                <select class="form-control" name="pages_id" id="pages_id">
                                <option value="">Select parent page</option>
                                  {!! $pageList !!}
                              </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control" required="required" placeholder="Title" value="@if(!empty($post->title)){{  $post->title }} @endif" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="5" placeholder="Description" name="description">@if(!empty($post->description)){{  $post->description }} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label>Page title</label>
                            <textarea class="form-control" rows="5" placeholder="Page Title" name="page_title">@if(!empty($post->page_title)){{  $post->page_title }} @endif</textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-warning">Reset
                        </button>                 
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
@section('customscript')
 @parent
  <script>
  $(document).ready(function(e) {
    var parentPageID = $("#pageid").val();
    $("#pages_id").val(parentPageID);
  });
  </script>
@endsection
