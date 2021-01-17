<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Helper\sHelper;
use DB;
use \App\Blogs;
use Auth;
use Illuminate\Support\Str;

class Admin extends Controller{
	
    public function index($page = "home" , $p1 = NULL){
	    $data['title'] = "sayari , kavita , daily news , daily uses , motivational quotes , motivational ";
		$data['user_details'] = Auth::user();
	     if($data['user_details'] == NULL || $data['user_details']->type != 2){
		     return redirect('dashboard');
		  }
	
		  
		if($page == "home" || $page == "create_page" || $page == "edit_page"){
		    $data['pageList'] = Page::get();
		  }
		if($page == "create_post"){
		  $data['pageList'] = Page::where([['private_status' , '=' , NULL]])->get();
		  } 
		if($page == "edit_page"){
		     $data['page_content'] = DB::table('pages')->where([['page_slug' , '=' , $p1]])->first();
		  }  
		if($page == "post_list"){
		    $data['post_list'] = Blogs::orderBy('created_at' , 'ASC')->get();
		  }  
		if($page == "edit_post"){
			 $data['pageList'] = Page::where([['private_status' , '=' , NULL]])->get();
		     $data['post'] = DB::table('blogs')->where([['title_slug' , '=' , $p1]])->first();
			//echo "<pre>";
			//print_r($data['post']);exit;
		  }  
		  if($page == "post_sayari"){
		  $data['pageList'] = Page::where([['private_status' , '=' , NULL]])->get();
		  }
		if($page == "sayari"){
		     $data['sayari'] = Blogs::where([['type' , '=' , 2]])->orderBy('created_at' , 'ASC')->get();
		  } 
		if($page == "edit_sayari"){
		   $data['pageList'] = Page::where([['private_status' , '=' , NULL]])->get();
		   $data['sayari_content'] = Blogs::where([['id' , '=' , $p1]])->first();
		  }
		  
	    if(!view()->exists("admin.$page"))
          return view("404")->with($data);
        else  
         return view("admin.$page")->with($data);
	}
	
	
	public function post_action(Request $request , $action){
	      if($action == "edit_sayari"){
		  $title = substr($request->sayari ,0 ,  20);
		  $title_slug = Str::slug($title);
		  $save_response = Blogs::where([['id' , '=' , $request->edit_id]])->update(['pages_id'=>$request->parent_id, 'title_slug'=>$title_slug , 'description'=>$request->sayari]);
		  if($save_response){
			 return redirect()->back()->with(['msg'=>'<div class="notice notice-success"><strong> Info , </strong> Post successfully upload  !!!. </div>']);
			}
		  else{
		      return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong>  Something went wrong please try again  !!!. </div>']);
			 } 
		}	
	  if($action == "save_sayari"){
		 $title = substr($request->sayari ,0 ,  20);
		 $title_slug = Str::slug($title);
		 /*echo "<pre>";
		 print_r($request->all());exit;*/
		 $save_response = Blogs::create(['users_id'=>Auth::user()->id, 'pages_id'=>$request->parent_id, 'title_slug'=>$title_slug, 'description'=>nl2br($request->sayari) , 'type'=>2]);
		  if($save_response){
			 return redirect()->back()->with(['msg'=>'<div class="notice notice-success"><strong> Info , </strong> Post successfully upload  !!!. </div>']);
			}
		  else{
		      return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong>  Something went wrong please try again  !!!. </div>']);
			 } 
		}	
	    /*Edit post*/
	  if($action == "edit_post"){
		 $image_name = $this->upload_single_file($request);
		 $save_response = Blogs::edit_post($request, $image_name);
		  if($save_response != FALSE){
			 return redirect()->back()->with(['msg'=>'<div class="notice notice-success"><strong> Info , </strong> Post successfully upload  !!!. </div>']);
			}
		  else{
		      return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong>  Something went wrong please try again  !!!. </div>']);
			 } 
		
		  
		 }
	  /*End*/	
	  /*save post script start*/
	  if($action == "save_post"){
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
			 return redirect()->back()->with(['msg'=>'<div class="notice notice-success"><strong> Info , </strong> Post successfully upload  !!!. </div>']);
			}
		  else{
		      return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong>  Something went wrong please try again  !!!. </div>']);
			 } 
		}
	  /*End*/	
		
	  /*edit page create*/
	  if($action == "edit_page"){
		  if(!empty($request->page_id)){
			if(!empty($request->page_name)){
			  $page_slug_name = sHelper::slug($request->page_name);
			  $save_response = DB::table('pages')
			                      ->where([['id' , '=' , $request->page_id]])
			                      ->update(['page_slug'=>$page_slug_name , 
								            'page_name'=>$request->page_name,
								            'page_title'=>$request->page_title, 
											'priority'=>1 , 'status'=>'A',
                                            'meta_key_word'=>$request->meta_keyword, 
			                                'meta_description'=>$request->meta_description,                                            
											'updated_at'=>date('Y-m-d H:i')]);
			  if($save_response){
				   return redirect('js_admin')->with(['msg'=>'<div class="notice notice-success">
                                           <strong>Success </strong> Page create Successful !!!.</div>.']);
				}
			  else{
				 return redirect()->back()->with(['msg'=>'<div class="notice notice-danger">
                                           <strong>Wrong </strong> Something went wrong , please try again  !!!.</div>.']);
				}	
			}
		  else{
			 return redirect()->back()->with(['msg'=>'<div class="notice notice-danger">
                                           <strong>Wrong </strong> Page name is required !!!.</div>.']); 
			  }	
			}
		}
	  /*End*/
	  /*save page name*/	
	  if($action == "save_page"){
		  if(!empty($request->page_name)){
			  $page_slug_name = sHelper::slug($request->page_name);
			  $save_response = DB::table('pages')->insert(['parent_id'=>$request->parent_id , 'page_slug'=>$page_slug_name , 'page_title'=>$request->page_title , 'page_name'=>$request->page_name , 'priority'=>1 , 'status'=>'A' ,
			   'meta_key_word'=>$request->meta_keyword, 
			   'meta_description'=>$request->meta_description, 'created_at'=>date('Y-m-d H:i') , 'updated_at'=>date('Y-m-d H:i')]);
			  if($save_response){
				   return redirect()->back()->with(['msg'=>'<div class="notice notice-success">
                                           <strong>Success </strong> Page create Successful !!!.</div>.']);
				}
			  else{
				 return redirect()->back()->with(['msg'=>'<div class="notice notice-danger">
                                           <strong>Wrong </strong> Something went wrong , please try again  !!!.</div>.']);
				}	
			}
		  else{
			 return redirect()->back()->with(['msg'=>'<div class="notice notice-danger">
                                           <strong>Wrong </strong> Page name is required !!!.</div>.']); 
			}	
		}
	  /*Save SEO content*/
	}
}


