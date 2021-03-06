@extends('admin.layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class=" col-sm-6">
        
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
              <li class="breadcrumb-item active">Url List </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Filters</h3>
                  </div>
                  <div class="card-body">
                    <input type="text" class="form-control" name="urlString" id="urlString" />
                    <button style="margin-top: 10px;" type="button" class="btn btn-success" name="searchUrl" id="searchUrl">Search Url</button>
                  </div>
            </div>
          </div>
         </div>  
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Post List</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered table-striped" id="user-list">
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>url</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@stop
@section('customscript')
 @parent
<script>
$(document).ready(function(e) {
$('#user-list').DataTable({
	"processing": true,
	"serverSide": true,
  "sScrollX": "100%",
  "sScrollXInner": "110%",
  "bScrollCollapse": true,
	"ajax":{
			 "url": "{{ route('seoManagement.urlList') }}",
			 "dataType": "json",
			 "type": "GET",
			 "data":function(d){
			    d.searchUrl = $("#urlString").val();
			 },
		   },
	"columns": [
		{ data:'sn',orderable:false},
        { data:'title'},
	    { data:'action',orderable:false},
	],
	'columnDefs': [ {
		'targets': [0], /* column index */
		'orderable': false, /* true or false */
	}]	 
}); 


/*roles on change*/	
$(document).on('click','#searchUrl',function(e){
   $('#user-list').DataTable().draw(true);
});
/*End*/
});
</script>
@endsection
