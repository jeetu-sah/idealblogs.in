<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Blogs;
use Mail;
use App\Mail\ContactMail;
use sHelper;

class Homecontroller extends Controller{
	
   public function index($page = "home" , $p1 = NULL){
	    $data['pages_detail'] = Page::where([['page_slug','=', $page]])->first();
		$data['category'] = Page::where([['private_status' , '=', NULL]])->get();
		if($page != "home"){
		    if($data['pages_detail'] == NULL){ return redirect()->back(); }
		   $data['posts'] = Blogs::where([['pages_id','=',$data['pages_detail']->id]])->orderBy('created_at' , 'DESC')->get();
		   echo '';
		  }
		else{
		    if($data['pages_detail'] == NULL){ return redirect()->back(); }
		   $data['posts'] = Blogs::where([['type' , '=' , 1]])->orderBy('created_at' , 'DESC')->get(); 
		  } 
		   if($data['pages_detail'] != NULL){
			   /*Seo section*/
				 $data['head_title'] = $data['pages_detail']->page_title;
				 $data['meta_description'] = $data['pages_detail']->meta_description;
				 $data['meta_keyword'] = $data['pages_detail']->meta_key_word;
				 $data['pageUrl'] = "https://jswebsolutions.in/";
				 $data['imageUrl'] = "";
				/*End*/
			 }
	      if($page == "about" || $page == "contact" || $page == "privacy-policy" || $page == "happy-whatsapp-status" || $page == "term-and-condition"){
		       $page = $page;
		  }	
		else{
		   $page = "index";	
		  }  	 
	    if(!view()->exists("front.$page"))
          return view("404")->with($data);
        else  
         return view("front.$page")->with($data);
	}
	

	public function aboutUs(){
		$data['head_title'] = 'About Us | idealblogs.in';
		return view("front.about")->with($data);
	}

	public function dmcaPolicy(){
		$data['head_title'] = 'DMCA Policy | idealblogs.in';
		return view("front.dmca-policy")->with($data);
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


