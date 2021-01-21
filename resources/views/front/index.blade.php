@extends('layout.master')
@section('content')
 <!-- Page Content -->
  <div class="container" id="postSectopn">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-8 my-4">
        @forelse($posts as $post)
          @php $image = 0; @endphp
          @if(!empty($post->image))
            @php $image = 1; @endphp
          @endif
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              @if(!empty($image))
                <div class="col-sm-6">
                  <img class="card-img-top" src='{{ asset("public/storage/$post->image") }}' alt="Card image cap">
                </div>
              @endif 
             <div class="col-sm-<?php if(!empty($image)) echo 6; else echo 12; ?>">
             <h1 class="h1-title">{{ $post->title }}</h1>
             <p class="card-text"> {!! $post->description !!} </p>
             @if($post->type == 1)
              <a target="_blank" href='{{ url("post/$post->title_slug") }}' class="btn btn-primary">Read More &rarr;</a>
              @endif
            </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            Posted on {{ date('M d Y' , strtotime($post->created_at)) }} by
            <a href="#">
                @php
                  $authour = sHelper::find_author($post->users_id);
                @endphp
                {{ $authour }}
            </a>
          </div>
        </div>
        @empty
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
             <div class="col-sm-6">
               <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
            </div>
             <div class="col-sm-6">
             <h1 class="h1-title">Post Title</h1>
             <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
            <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            Posted on January 1, 2017 by
            <a href="#">Start Bootstrap</a>
          </div>
        </div>
        @endforelse
        <!--<ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul>-->
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
        <!-- Categories Widget -->
		@include('front.component.category')
        <!-- Side Widget -->
        <!--<div class="card my-4">-->
        <!--  <h5 class="card-header">Side Widget</h5>-->
        <!--  <div class="card-body">-->
        <!--    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!-->
        <!--  </div>-->
        <!--</div>-->

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@stop