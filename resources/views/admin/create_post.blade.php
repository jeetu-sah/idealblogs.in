@extends('layout.master')
@section('content')
 <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-4">
        @include('admin.component.sidebar') 
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-8">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header"><a href="<?php echo url('js_admin/post_list'); ?>">Create Post</a></h5>
          <div class="card-body">
           @if(Session::has('msg'))
               {!!  Session::get("msg") !!}
             @endif
              <form action="<?php echo url("js_admin/save_post") ?>" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" id="image" class="form-control" required="required" placeholder="Title"  />
                                        </div>
                                        <div class="form-group">
                                            <label>Select page </label>
                                              <select class="form-control" name="pages_id" id="">
                                              <option value="">Select parent page</option>
                                                @foreach($pageList as $page)
                                                <option value="<?php echo $page->id; ?>"><?php echo $page->page_name; ?></option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" id="title" class="form-control" required="required" placeholder="Title" value="{{ old('title') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="5" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Page title</label>
                                            <textarea class="form-control" rows="5" placeholder="Page Title" name="page_title">{{ old('page_title') }}</textarea>
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
  </div>
@stop