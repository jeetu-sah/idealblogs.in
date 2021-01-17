<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Image; 

class Controller extends BaseController{
	
	
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public $imageArr = array("jpeg" , "png" , "jpg" , "JPEG" , "PNG" ,"JPG", "pdf" , "PDF");
	public $document_arr = array("PDF" , "pdf");
	
	
	public function upload_single_file($request){
	  if(!empty($request->image)){
		 $pdf_path = public_path('storage/');
		  if(!is_dir($pdf_path)){ mkdir($pdf_path, 0755, true); }
			$filename = md5(microtime()).'.'.$request->file('image')->getClientOriginalExtension();
			
			if(in_array( $request->file('image')->getClientOriginalExtension() , $this->imageArr)){
				$request->file('image')->move($pdf_path  , $filename);
				return $filename;
			}
			else{ return 100; }
		}
	  else{
		  return  $request->image_old;	
		}	
	}
	

}
