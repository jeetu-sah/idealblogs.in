<?php
namespace App\Helper;
use Auth;
use App\Category;
use App\User , App\Page;

class sHelper{
  
  static $notifications = null;
  
  
  public static function find_author($user_id = NULL){
      if($user_id != NULL){
           $user = User::find($user_id);
           if($user != NULL){
               return $user->name;
           }
      }
      else{
          return "Admin";
      }
    
    
  }
	
  public static function get_user_detail($user_id){
     $user = \App\User::find($user_id);
	 if($user != NULL){
	     return $user->f_name." ".$user->l_name;
	   } 
	 else{
	    return "Js web solutions";
	  }  
  }
  
  public static function makeHindiSlug($string, $separator = '-'){
        if (is_null($string)) {
            return "";
        }
        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }
	
  public static function get_how_many_year_old($dob){
    //  return $dob;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dob), date_create($today)); 
    return $diff->format('%y');
   }

   public static function parentPages(){
        $parentPages = Page::where([['parent_id','=',NULL]])->get();
        if($parentPages->count() > 0){
			$option = '<option value="0">Select Parent Aminities </option>';
			foreach($parentPages as $page){
				$option .= self::print_category_table($page->page_name ,$page->id); 			
				$option .= self::get_child_cat_table($page->page_name , $page->id ); 
			}
			return $option;  
		}	
		else{
			$option = '<option value="0">No pages available !!!</option>';
		}
    } 

    /*Manage Script start*/
	public static function get_child_cat_table($cat_name , $parent_id){
		$category_response_table = '';
		$get_child_cat = Page::where([['parent_id','=',$parent_id]])->get();
		if($get_child_cat->count() > 0){
			$parent_cat_name = ''; $final_cat_name = '';
			foreach($get_child_cat as $subcat){
					$parent_cat_name = $cat_name." >> ";
					$final_cat_name  = $parent_cat_name.$subcat->page_name;
					$category_response_table .= self::print_category_table($final_cat_name , $subcat->id); 
					$category_response_table .= self::get_child_cat_table($final_cat_name , $subcat->id);
				}
			}
		else { $symbol = ""; } 
		return $category_response_table;   	 
	}
    /*End*/
    
    
	public static function print_category_table($name , $id){
	  $option = '';	
      $option .= '<option value='.$id.'>'.$name.'</option>';
      return $option;											  
	}    
        
    
   public static function slug($text){
	   $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	   $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		  $text = preg_replace('~[^-\w]+~', '', $text);
		  $text = trim($text, '-');
		  $text = preg_replace('~-+~', '-', $text);
		  $text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		  }
		return $text;
	}
    
    
   
   
    public static function distance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $km = $miles * 1.609344;
        if ($km < 1){
            return round($miles * 1609.344).' Meter';
        }
        return round($km, 2).' Km';
    }
	
   
	
    public static function ip($request){
        $ip = $request->headers->get('CF_CONNECTING_IP');
        if (empty($ip))$ip = $request->ip();
        return $ip;
    }

    
	
}