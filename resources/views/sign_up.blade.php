@extends('layout.master')
@section('content')
 <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-4">
       <!-- <h5 class="card-header">Search</h5>-->
         <div class="card-body">
          
         </div>
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-8">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Sign up</h5>
          <div class="card-body">
          <ul>
              @if(Session::has('msg'))
               {!!  Session::get("msg") !!}
             @endif
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
          <form action="<?php echo url("signup_post") ?>" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control" required="required" placeholder="Mobile" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="password" id="password" class="form-control" required="required" placeholder="Password" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="text" name="confirm_password" id="password" class="form-control" required="required" placeholder="Confirm Password" value="" />
                                        </div>
                                        <div class="form-group">
                                             <input type="checkbox" name="remember_me" value="1" />&nbsp;Remember Me
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <a href="<?php echo url("login") ?>" class="btn btn-primary">login</a>
                                    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop        
