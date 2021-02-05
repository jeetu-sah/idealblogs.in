@extends('layout.master')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="card my-4">
                    @if (!empty($post_detail->image))
                        <img class="card-img-top" src="{{ asset('public/storage/'.$post_detail->image) }}" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $post_detail->title }}</h2>
                        @if ($pageLinked != false)
                            <?php include $pageLinked; ?>
                        @else
                        @endif
                        <!--<p class="card-text <?php if (empty($post_detail->image)) {
                    echo 'text-center';
                } ?>">{{ $post_detail->description }}</p>-->
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ date('M d Y', strtotime($post_detail->created_at)) }} by
                        <a href="#">Admin</a>
                    </div>
                </div>
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Search Widget -->
                <!--<div class="card my-4">
              <h5 class="card-header">Search</h5>
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>-->
                <!-- Categories Widget -->
                @include('front.component.category')
                <!-- Side Widget -->
                <!--<div class="card my-4">
              <h5 class="card-header">Side Widget</h5>
              <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
              </div>
            </div>-->

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@stop
