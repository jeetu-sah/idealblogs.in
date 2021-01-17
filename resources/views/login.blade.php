@extends('layout.master')
@section('content')
 <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-4">
        <h5 class="card-header">Search</h5>
         <div class="card-body">
          
         </div>
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-8">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Login</h5>
          <div class="card-body">
          <ul>
            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                             @endif
        </ul>
        @if(Session::has('msg'))
               {!!  Session::get("msg") !!}
             @endif
          <form action="<?php echo url("login_post") ?>" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control" required="required" placeholder="Mobile" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="password" id="password" class="form-control" required="required" placeholder="Password" value="" />
                                        </div>
                                        <div class="form-group">
                                             <input type="checkbox" name="remember_me" value="1" />&nbsp;Remember Me
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                         <a href="<?php echo url("sign-up") ?>" class="btn btn-primary">Sign Up</a>
                                    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop        
