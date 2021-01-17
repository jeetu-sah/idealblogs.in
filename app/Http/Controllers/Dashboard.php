<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Blogs;
use Mail;
use App\Mail\ContactMail;
use Auth;

class Dashboard extends Controller{
	
   public function index($page = "home" , $p1 = NULL){
       $data['title'] = "sayari , kavita , daily news , daily uses , motivational quotes , motivational ";
       
       if($page == "home"){
		   $data['post_list'] = Blogs::where([['users_id' , '=' , Auth::user()->id]])->get();
		} 
	   if($page == "create_story"){
	      $data['pageList'] = Page::where([['private_status' , '=' , NULL]])->get();
	      //echo "<pre>";
	      //print_r($data['pageList']);exit;
	   }	
		  
        if(!view()->exists("dashboard.$page"))
          return view("404")->with($data);
        else  
         return view("dashboard.$page")->with($data);
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
}


