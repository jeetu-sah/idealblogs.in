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
             @if(Session::has('msg'))
               {!!  Session::get("msg") !!}
             @endif
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
              <form action="<?php echo url("js_admin/edit_sayari") ?>" method="post">
                                    @csrf
                                        <div class="form-group">
                                           <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $sayari_content->id; ?>" readonly />
                                            <label>Select Sayari status </label>
                                              <select class="form-control" name="parent_id" id="">
                                                @foreach($pageList as $page)
                                                <option value="<?php echo $page->id; ?>" <?php if(!empty($sayari_content->pages_id)) if($sayari_content->pages_id == $page->id) echo "Selected"; ?>><?php echo $page->page_name; ?></option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sayari</label>
                                            <textarea class="form-control" rows="5" placeholder="Sayari" name="sayari" ><?php if(!empty($sayari_content->description)) echo strip_tags($sayari_content->description); ?></textarea>
                                        </div>
                                        
                                        <button type="submit" name="submit" class="btn btn-success">Post</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop