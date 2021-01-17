<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SitemapController extends Controller{
   
   public function index(){
       //$urls = \App\Sitemap::orderBy('updated_at', 'desc')->get();
	  // echo "<pre>";
	   //print_r($urls);exit;
	   $urls = NULL;
		return response()->view('sitemap.index', [
		  'urls' => $urls,
		])->header('Content-Type', 'text/xml');
    }
	
    public static function post_action(Request  $request){
	  
	}	
   
}
