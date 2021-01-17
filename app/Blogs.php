<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use sHelper;
use Auth;

class Blogs extends Model{
   
    protected $table =  "blogs";
     protected $fillable = ['id' , 'users_id', 'pages_slug_name', 'pages_id', 'title_slug',  'title','description' ,  'image'  , 'image_url' , 'page_title' , 'meta_keyword' , 'meta_description', 'deleted_at' , 'created_at' , 'updated_at','type'
    ];
    
    
    public static function edit_post($request , $image_name = NULL){
		$image_url = url("public/storage/$image_name");
		$slug_title = sHelper::makeHindiSlug($request->title);
	    return Blogs::where([['id' , '=', $request->editid]])
		             ->update(['users_id'=>Auth::user()->id,
		               'pages_id'=>$request->pages_id,  
					   'title_slug'=>$slug_title ,
					   'title'=>$request->title, 
		               'description'=>$request->description, 
		               'image'=>$image_name , 
		               'image_url'=>$image_url, 
					   'page_title'=>$request->page_title ,
					   'meta_keyword'=>$request->meta_keyword , 
					   'meta_description'=>$request->meta_description
					   ]);
	}
	
	public static function save_post($request , $image_name = NULL){
		$image_url = url("public/storage/$image_name");
		//$slug_title = sHelper::slug($request->title);
		$slug_title =  sHelper::makeHindiSlug($request->title);
	    return Blogs::create(['users_id'=>Auth::user()->id,'pages_id'=>$request->pages_id,  'title_slug'=>$slug_title , 'title'=>$request->title, 
		               'description'=>$request->description, 
		               'image'=>$image_name , 
		               'image_url'=>$image_url, 
					   'page_title'=>$request->page_title ,
					   'meta_keyword'=>$request->meta_keyword , 
					   'meta_description'=>$request->meta_description
					   ]);
	}
	
}
