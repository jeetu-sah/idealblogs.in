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
          <h5 class="card-header">&nbsp;<a class="btn btn-warning" href="<?php echo url('js_admin/create_page'); ?>">Create  Page</a></h5>
          <div class="card-body">
            <table class="table table-responsive">
                                    <thead>
                                       <tr>
                                         <th>Sn.</th>
                                         <th>Page Title</th>
                                         <th>Meta key word</th>
                                         <th>Meta Description</th>
                                         <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
										 @forelse($pageList as $postArr)
										   <tr>
                                            <th><?php echo $loop->iteration; ?></th>
                                            <td><?php if(!empty($postArr->page_name))echo $postArr->page_name; ?></td>
                                            <td><?php if(!empty($postArr->meta_key_word))echo $postArr->meta_key_word; ?></td>
                                            <td><?php if(!empty($postArr->meta_description))echo $postArr->meta_description; ?></td>
                                           <th><a href="<?php echo url("js_admin/edit_page/$postArr->page_slug"); ?>" class="btn btn-primary">Edit</a></th>
                                      </tr>
									     @empty
										  <tr>
                                           <td colspan="4">No Record found</td>
                                          </tr>
										 @endforelse
                                    </tbody>
                                  </table>                                        
          </div>
        </div>
      </div>
    </div>
  </div>
@stop