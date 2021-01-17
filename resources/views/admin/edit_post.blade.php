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
              <form action="<?php echo url("js_admin/edit_post") ?>" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="hidden" name="editid" id="editid" class="form-control" value="<?php if(!empty($post->id))echo $post->id; ?>"  />
                                            <input type="file" name="image" id="image" class="form-control"  placeholder="Title"  />
                                            <input type="hidden" name="image_old" id="image_old" value="@if(!empty($post->image)){{  $post->image }} @endif">
                                        </div>
                                        <div class="form-group">
                                            <label>Select page </label>
                                              <select class="form-control" name="pages_id" id="">
                                              <option value="">Select parent page</option>
                                                @foreach($pageList as $page)
                                                <option value="<?php echo $page->id; ?>" <?php if($page->id == $post->pages_id)  echo "selected"; ?>><?php echo $page->page_name; ?></option>
                                                @endforeach
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
                                        <div class="form-group">
                                            <label>Meta Keyword</label>
                                            <textarea class="form-control" rows="5" placeholder="Meta Keyword" name="meta_keyword" >@if(!empty($post->meta_keyword)){{  $post->meta_keyword }} @endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta description</label>
                                            <textarea class="form-control" rows="5" placeholder="Meta Description" name="meta_description" >@if(!empty($post->meta_description)){{  $post->meta_description }} @endif</textarea>
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