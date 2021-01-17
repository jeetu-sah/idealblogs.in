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
          <h5 class="card-header">Search</h5>
          <div class="card-body">
              <form action="<?php echo url("js_admin/edit_page") ?>" method="post">
                                    @csrf
                                        <input type="hidden" name="page_id" id="page_id" value="<?php if(!empty($page_content->id)) echo $page_content->id; ?>" readonly>
                                        <div class="form-group">
                                            <label>Select Parent page </label>
                                              <select class="form-control" name="parent_id" id="">
                                                <option value="">Select parent page</option>
                                                @foreach($pageList as $page)
                                                <option value="<?php echo $page->id; ?>" <?php if(!empty($page_content->parent_id)) if($page_content->parent_id == $page->id) echo "selected"; ?>><?php echo $page->page_name; ?></option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <input type="text" name="page_name" id="page_name" class="form-control" required="required" placeholder="Page Name" value="@if($page_content->page_name){{ $page_content->page_name }}@endif" />
                                        </div>
                                        <div class="form-group">
                                            <label>Page title</label>
                                            <textarea class="form-control" rows="5" placeholder="Title" name="page_title" >@if(!empty($page_content->page_title)){{ $page_content->page_title }}@endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keyword</label>
                                            <textarea class="form-control" rows="5" placeholder="Meta Keyword" name="meta_keyword" >@if($page_content->meta_key_word){{ $page_content->meta_key_word }}@endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta description</label>
                                            <textarea class="form-control" rows="5" placeholder="Post Description" name="meta_description" >@if($page_content->meta_description){{ $page_content->meta_description }}@endif</textarea>
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
