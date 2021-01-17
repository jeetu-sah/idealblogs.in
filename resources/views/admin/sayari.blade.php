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
          <h5 class="card-header">&nbsp;<a class="btn btn-warning" href="<?php echo url('js_admin/post_sayari'); ?>">Post Sayari</a></h5>
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
                                    @forelse($sayari as $saya)
										<tr>
                                         <th>{{ $loop->iteration }}</th>
                                         <td>{!! $saya->description !!}</td>
                                         <th><a href="<?php echo url("js_admin/edit_sayari/$saya->id") ?>">Edit</a></th>
                                       </tr>
                                    @empty   
                                    @endforelse   
                                    </tbody>
                                  </table>                                        
          </div>
        </div>
      </div>
    </div>
  </div>
@stop