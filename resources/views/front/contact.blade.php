@extends('layout.master')
@section('content')
 <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="<?php echo url("public/image/contact-us.jpg") ?>" alt="Card image cap">
          <div class="card-body">
            <h1 class="card-title">Contact Us</h1>
              @if(Session::has('msg'))
               {!!  Session::get("msg") !!}
             @endif
            <hr />
              <form action="<?php echo url("contact_send") ?>" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name" value="{{ old('name') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control" required="required" placeholder="Email" value="{{ old('email') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control" required="required" placeholder="Mobile" value="{{ old('email') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="5" placeholder="Message" name="description" >{{ old('description') }}</textarea>
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