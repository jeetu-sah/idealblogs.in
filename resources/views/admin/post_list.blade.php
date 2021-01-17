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
          <h5 class="card-header">&nbsp;<a class="btn btn-warning" href="<?php echo url('js_admin/create_post'); ?>">Create  Post</a></h5>
          <div class="card-body">
            <table class="table table-responsive">
                                    <thead>
                                       <tr>
                                         <th>Sn.</th>
                                         <th>Page Title</th>
                                         <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
										 @forelse($post_list as $post)
										   <tr>
                                            <th><?php echo $loop->iteration; ?></th>
                                            <td><?php if(!empty($post->title))echo $post->title; ?></td>
                                           <th><a href="<?php echo url("js_admin/edit_post/$post->title_slug"); ?>" class="btn btn-primary">Edit</a></th>
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