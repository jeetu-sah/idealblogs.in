<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Blogs , App\User , App\SeoModel;
use Mail;
use App\Mail\ContactMail;
use Auth;
use sHelper;
use DB;

class Dashboard extends Controller{
	
   public function index($page = "home" , $p1 = NULL){
	   $data['title'] = "sayari , kavita , daily news , daily uses , motivational quotes , motivational ";
	   	if($page == "add-page" || $page == "edit-page"){
			$data['pageList'] = sHelper::parentPages();
			if(!empty($p1)){
				$data['page_content'] = DB::table('pages')->where([['id','=',$p1]])->first();
			}
		}
        if($page == "add-post" || $page == "edit-post"){
			$data['post'] = NULL;
		    $data['pageList'] = sHelper::parentPages();
		   	if(!empty($p1)){
			   $data['post'] = DB::table('blogs')->where([['id','=',$p1]])->first();
			}
		} 
		if($page == "home"){
		   $data['post_list'] = Blogs::where([['users_id' , '=' , Auth::user()->id]])->get();
		} 
		if($page == "create_story"){
			$data['pageList'] = Page::where([['private_status' , '=' , NULL]])->get();
		}	
		if($page == "edit-url"){
			if(!empty($p1)){
				$data['pageContent'] = SeoModel::where([['id','=',$p1]])->get();
				
			}
		}
		if($page == "removePage"){
			if(!empty($p1)){
				$pageDetail = Page::find($p1);
				if($pageDetail != NULL){
					$pageDetail->deleted_at=  now();
					if($pageDetail->save()){
						return redirect()->back()->with(['msg'=>'<p class="alert alert-success"><strong> Success , </strong>Delete successfully !!!. </p>']);
					}
				}
			}
		}
		  
		if(!view()->exists("admin.$page"))
			return view("404")->with($data);
		else  
			return view("admin.$page")->with($data);
	}
	
	
	public function contact_send(Request $request){
	    $data =  array('name'=>$request->name,
		               'email'=>$request->email ,
		               'message'=>$request->description);
		$mail  = Mail::to('jitendrasahu17996@gmail.com')->send(new ContactMail($data));
        return redirect()->back()->with(['msg'=>'<p class="alert alert-success"><strong> Success , </strong>Message send successfully ,  We will contact shortly !!!. </p>']);
        
      
	}
	
	
	

	public function post($post_title){
	   if(empty($post_title)){ return redirect()->back(); } 
	   $data['category'] = Page::where([['private_status' , '=', NULL]])->get();
	   $data['post_detail'] = Blogs::where([['title_slug' , '=',$post_title]])->first();
	   if($data['post_detail'] != NULL){
				$data['head_title'] = $data['post_detail']->title;	
			    $data['description'] = $data['post_detail']->description;
				$image = $data['post_detail']->image;
				$title_url = $data['post_detail']->title_url;
			     $data['imageUrl'] = $data['post_detail']->image_url;
				$data['pageUrl'] = url("blogPost/$title_url");
				$load_html_page = $data['post_detail']->id.'.html';
				/*echo "<pre>";
				print_r($load_html_page);exit;
				exit;*/
				$folder = public_path("pages/");
				$data['pageLinked'] = $folder."/".$load_html_page;
				if(!file_exists($data['pageLinked'])){
					$data['pageLinked'] = FALSE;
				  }
				/*page meta keyword*/
				$data['meta_keyword'] = $data['post_detail']->meta_keyword;
				$data['meta_description'] = $data['post_detail']->meta_description;
				$data['meta_title'] = $data['post_detail']->meta_title;
				/*End*/  
			  }
		if(!view()->exists("front.post"))
          return view("404")->with($data);
        else  
         return view("front.post")->with($data);
	}



	public function postList(Request $request){
		$limit = request()->input('length');
		$start = request()->input('start');
		$columns = array(0=>'id' , 1=>'f_name', 2=>'mobile', 3=>'name');
		$dir = $request->input('order.0.dir');
		if($dir == "asc"){ $dir = "ASC"; }
		else{ $dir = "DESC"; }
		$order = $columns[$request->input('order.0.column')];
		$postQuery = Blogs::where([['deleted_at','=',NULL],])->orderBy('id','DESC');
		$totalRecord = $postQuery->count();
		$posts = $postQuery->skip($start)->take($limit)->get();
		$partners_lists = [];
		if($posts->count() > 0){
			$i = 1;
			foreach($posts as $post){
				$change_credential = NULL;	
				$delete_btn =  "<a href='javascript::void()' data-partnerid='".$post->id."' data-toggle='tooltip' title='Add category' class='btn btn-danger remove_partner' style='margin-right: 5px;'><i class='fas fa-trash'></i></a>&nbsp;";
				$edit_btn = '<a href="'.url("dashboard/edit-post/".$post->id).'" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
				<i class="fas fa-edit"></i> 
				</a>';	
				$postArr = [];
				$postArr['sn'] = $post->id;
				$postArr['title'] = $post->title;
				$postArr['action'] = $delete_btn.' '.$edit_btn." ".$change_credential;
				$i++;
				$partners_lists[] = $postArr;
			}
		}

		$json_data = array(
			"draw"            => intval(request()->input('draw')),  
			"recordsTotal"    => intval($totalRecord),  
			"recordsFiltered" => intval($totalRecord), 
			"data"            => $partners_lists   
		);
        return json_encode($json_data); exit;
	}

	public function pageList(Request $request){
		$limit = request()->input('length');
		$start = request()->input('start');
		$columns = array(0=>'id' , 1=>'f_name', 2=>'mobile', 3=>'name');
		$dir = $request->input('order.0.dir');
		if($dir == "asc"){ $dir = "ASC"; }
		else{ $dir = "DESC"; }
		$order = $columns[$request->input('order.0.column')];
		$pageQuery = Page::query();
		$totalRecord = $pageQuery->count();
		$pages = $pageQuery->skip($start)->take($limit)->get();
		$partners_lists = [];
		if($pages->count() > 0){
			$i = 1;
			foreach($pages as $page){
				$change_credential = NULL;	
				$delete_btn =  "<a href='javascript::void()' data-pageid='".$page->id."' data-toggle='tooltip' title='Add category' class='btn btn-danger removePage' style='margin-right: 5px;'><i class='fas fa-trash'></i></a>&nbsp;";

				$edit_btn = '<a href="'.url("dashboard/edit-page/".$page->id).'" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
				<i class="fas fa-edit"></i> 
				</a>';	
				$postArr = [];
				$postArr['sn'] = $i;
				$postArr['title'] = $page->page_name;
				$postArr['action'] = $delete_btn.' '.$edit_btn." ".$change_credential;
				$i++;
				$partners_lists[] = $postArr;
			}
		}

		$json_data = array(
			"draw"            => intval(request()->input('draw')),  
			"recordsTotal"    => intval($totalRecord),  
			"recordsFiltered" => intval($totalRecord), 
			"data"            => $partners_lists   
		);
        return json_encode($json_data); exit;
	}

	/*save post */
	public function savePost(Request $request){
		$image_name = NULL;
		  if(!empty($request->image)){
			  $image_name = $this->upload_single_file($request);
			  if($image_name == 100){
				  echo "Plase check your image extension .";exit;
				}
			}
		  $save_response = Blogs::save_post($request, $image_name);
		  if($save_response != FALSE){
		      if($save_response){
				 $location = url("public/pages/");
				 //$myFile = $location.$data['success'].".html";
				 $myFile = "public/pages/".$save_response->id.".html";
				 $fh = fopen($myFile,'w');
				 $stringData = "";
				 fwrite($fh, $stringData);
				 fclose($fh);
			   }
			 return redirect()->back()->with(['msg'=>'<div class="alert alert-success"><strong> Info , </strong> Post successfully upload  !!!. </div>']);
			}
		  else{
		      return redirect()->back()->with(['msg'=>'<div class="alert alert-danger"><strong> Wrong , </strong>  Something went wrong please try again  !!!. </div>']);
			 } 
	}
	/*End*/

	public function savePage(Request $request){
		$page_slug_name = sHelper::slug($request->page_name);
		$save_response = Page::updateOrCreate(['page_slug'=>$page_slug_name],[
												'parent_id'=>$request->parent_id,
												'page_slug'=>$page_slug_name ,
												'page_title'=>$request->page_title ,
												'page_name'=>$request->page_name , 
												'priority'=>1 , 'status'=>'A' ,
												'meta_description'=>$request->meta_description]);

		if($save_response){
			return redirect()->back()->with(['msg'=>'<div class="alert alert-success">
									<strong>Success </strong> Page create Successful !!!.</div>.']);
		}
		else{
			return redirect()->back()->with(['msg'=>'<div class="alert alert-danger">
									<strong>Wrong </strong> Something went wrong , please try again  !!!.</div>.']);
		}	
	}	
	
}


