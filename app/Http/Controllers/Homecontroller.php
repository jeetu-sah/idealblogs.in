<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Blogs;
use Mail;
use App\Mail\ContactMail;
use sHelper;
use DB;

class Homecontroller extends Controller{
	
   public function index($page = "home" , $p1 = NULL){
	   $request_url = request()->fullUrl();
	   $data['head_title'] = $data['meta_keyword'] = $data['meta_description']  = NULL;
	   $seo_content = DB::table('seo_content_tbl')->where([['page_url','=',(string)$request_url]])->first();
	   if($seo_content != NULL){
		   $data['head_title'] = $seo_content->page_title;
		   $data['meta_keyword'] = $seo_content->meta_key_word;
		   $data['meta_description'] = $seo_content->meta_description;
		}
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
		//$data['posts'] = $data['category']  = collect();
		$data['category'] = Page::where([['private_status' , '=', NULL]])->get();
		$data['posts'] = Blogs::where([['type','=',1]])->orderBy('created_at','DESC')->get(); 	
	    if($page == "contact" || $page == "privacy-policy" || $page == "happy-whatsapp-status"){
		    $page = $page;
		}else{
		   $page = "index";	
		}  	
	

	    if(!view()->exists("front.$page"))
          return view("404")->with($data);
        else  
         return view("front.$page")->with($data);
	}

	public function category($page = "education" , $p1 = NULL){
		$data['posts'] = collect();
		$request_url = request()->fullUrl();
		$data['head_title'] = $data['meta_keyword'] = $data['meta_description']  = NULL;
		$seo_content = DB::table('seo_content_tbl')->where([['page_url','=',(string)$request_url]])->first();
		if($seo_content != NULL){
			$data['head_title'] = $seo_content->page_title;
			$data['meta_keyword'] = $seo_content->meta_key_word;
			$data['meta_description'] = $seo_content->meta_description;
		}
		/*find view post */
		$pages = DB::table('pages')->where([['page_slug','=',(string)$page]])->first();
		if($pages != NULL){
			$data['posts'] = Blogs::where([['pages_id','=',$pages->id]])->orderBy('created_at','DESC')->get(); 	
		}
		$data['category'] = Page::where([['private_status' , '=', NULL]])->get();
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
		/*end*/

		if(!view()->exists("front.index"))
          return view("404")->with($data);
        else  
         return view("front.index")->with($data);
	}
	

	public function aboutUs(){
		$data['head_title'] = 'About Us | idealblogs.in';
		$request_url = request()->fullUrl();
	    $seo_content = DB::table('seo_content_tbl')->where([['page_url','=',$request_url]])->first();
	 	if($seo_content != NULL){
		   $data['head_title'] = $seo_content->page_title;
		   $data['meta_keyword'] = $seo_content->meta_key_word;
		   $data['meta_description'] = $seo_content->meta_description;
		}
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
		return view("front.about")->with($data);
	}

	public function privacyPolicy(){
		$data['head_title'] = 'Privacy Policy | idealblogs.in';
		$request_url = request()->fullUrl();
	    $seo_content = DB::table('seo_content_tbl')->where([['page_url','=',(string)$request_url]])->first();
	 	if($seo_content != NULL){
		   $data['head_title'] = $seo_content->page_title;
		   $data['meta_keyword'] = $seo_content->meta_key_word;
		   $data['meta_description'] = $seo_content->meta_description;
		}
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
		return view("front.privacy-policy")->with($data);
	}

	public function dmcaPolicy(){
		$data['head_title'] = 'DMCA Policy | idealblogs.in';
		$request_url = request()->fullUrl();
	    $seo_content = DB::table('seo_content_tbl')->where([['page_url','=',(string)$request_url]])->first();
	 	if($seo_content != NULL){
		   $data['head_title'] = $seo_content->page_title;
		   $data['meta_keyword'] = $seo_content->meta_key_word;
		   $data['meta_description'] = $seo_content->meta_description;
		}
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
		return view("front.dmca-policy")->with($data);
	}
	
	public function termAndCondition(){
		$data['head_title'] = 'DMCA Policy | idealblogs.in';
		$request_url = request()->fullUrl();
	    $seo_content = DB::table('seo_content_tbl')->where([['page_url','=',(string)$request_url]])->first();
	 	if($seo_content != NULL){
		   $data['head_title'] = $seo_content->page_title;
		   $data['meta_keyword'] = $seo_content->meta_key_word;
		   $data['meta_description'] = $seo_content->meta_description;
		}
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
		return view("front.term-and-condition")->with($data);
	}
	
	public function contact_send(Request $request){
	    $data =  array('name'=>$request->name,
		               'email'=>$request->email ,
		               'message'=>$request->description);
		$mail  = Mail::to('jitendrasahu17996@gmail.com')->send(new ContactMail($data));
        return redirect()->back()->with(['msg'=>'<p class="alert alert-success"><strong> Success , </strong>Message send successfully ,  We will contact shortly !!!. </p>']);
        
      
	}
	
	
	public function post($post_title){
		$data = [];
		$data['head_title'] = $data['meta_keyword'] = $data['meta_description'] =NULL;
		$request_url = request()->fullUrl();
		$seo_content = DB::table('seo_content_tbl')->where([['page_url','=',$request_url]])->first();
		if($seo_content != NULL){
		   $data['head_title'] = $seo_content->page_title;
		   $data['meta_keyword'] = $seo_content->meta_key_word;
		   $data['meta_description'] = $seo_content->meta_description;
		}
		// echo $data['head_title']."<br />".$data['meta_keyword']."<br />".$data['meta_description'];exit;
		/*header nav start*/
		$data['headerNavs'] = Page::where([['parent_id','=',NULL]])->select('page_name','page_slug')->take(10)->get();
		/*end*/
	   if(empty($post_title)){ return redirect()->back(); } 
	   $data['category'] = Page::where([['private_status' , '=', NULL]])->get();
	   $data['post_detail'] = Blogs::where([['title_slug' , '=',$post_title]])->first();
	   if($data['post_detail'] != NULL){
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
			  }
		if(!view()->exists("front.post"))
          return view("404")->with($data);
        else  
         return view("front.post")->with($data);
	}
}


