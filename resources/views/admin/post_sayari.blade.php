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
              <form action="<?php echo url("js_admin/save_sayari") ?>" method="post">
                                    @csrf
                                        <div class="form-group">
                                            <label>Select Sayari status </label>
                                              <select class="form-control" name="parent_id" id="">
                                                @foreach($pageList as $page)
                                                <option value="<?php echo $page->id; ?>"><?php echo $page->page_name; ?></option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sayari</label>
                                            <textarea class="form-control" rows="5" placeholder="Sayari" name="sayari" >{{ old('sayari') }}</textarea>
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