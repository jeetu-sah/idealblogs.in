 @if($category->count() > 0)
			 <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                  @forelse($category as $cat)
                  <a  href='@if(!empty($cat->page_slug)){{ url("$cat->page_slug") }} @endif' class="btn btn-warning btn-sm" style="font-size:12.482269503546px; margin:5px;" aria-label="3D Slider (37 items)">@if(!empty($cat->page_name)){{ $cat->page_name}} @endif&nbsp; <span class="badge badge-light">5</span></a>
                  @empty
                  @endif
              </div>
            </div>
          </div>
        </div>
		 @endif 