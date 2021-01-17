<?php
namespace App\Helper;
use Auth;
use App\Category;
use App\User;

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
	
    public static function notifications(){
        if (self::$notifications == null){
            $notifications = [];
            $user = Auth::user();
            $followers = $user->follower()->where('allow', 0)->count();
            if ($followers > 0){
                $notifications[] = [
                    'url' => url('/followers/pending'),
                    'icon' => 'fa-user-plus',
                    'text' => $followers.' follower requests'
                ];
            }
            $relatives = $user->relatives()->where('allow', 0)->count();
            if ($relatives > 0){
                $notifications[] = [
                    'url' => url('/relatives/pending'),
                    'icon' => 'fa-user-circle-o',
                    'text' => $relatives.' relatives requests'
                ];
            }
            $comments = PostComment::where('seen', 0)->with('user')->join('posts', 'posts.id', '=', 'post_comments.post_id')
                ->where('posts.user_id', $user->id)->where('user_id', '!=', $user->id)->select('post_comments.*')->orderBy('id', 'DESC');
            if ($comments->count() > 0){
                foreach ($comments->get() as $comment){
                    $notifications[] = [
                        'url' => url('/post/'.$comment->post_id),
                        'icon' => 'fa-commenting',
                        'text' => $user->name.' left a comment on your post.'
                    ];
                }
            }
            $likes = PostLike::where('seen', 0)->with('user')->join('posts', 'posts.id', '=', 'post_likes.post_id')
                ->where('posts.user_id', $user->id)->where('user_id', '!=', $user->id)->select('post_likes.*')->orderBy('id', 'DESC');
            if ($likes->count() > 0){
                foreach ($likes->get() as $likne){
                    $notifications[] = [
                        'url' => url('/post/'.$likne->post_id),
                        'icon' => 'fa-heart',
                        'text' => $user->name.' liked your post.'
                    ];
                }
            }
            $follow= UserNotification::where(['read_at' => NULL, 'notifiable_id' => $user->id])->orderBy('created_at', 'DESC')->take(10); 
            if ($follow->count() > 0){
                foreach ($follow->get() as $row){
                    $notifications[] = [
                        'url' => url('#'),
                        'icon' => 'fa-user',
                        'text' => $row->data
                    ];
                }
                UserNotification::where('read_at', NULL)->update(['read_at' => date('Y-m-d h:i:s')]); 
            }
            
            self::$notifications = $notifications;
        }
        return self::$notifications;
    }
	
    public static function ip($request){
        $ip = $request->headers->get('CF_CONNECTING_IP');
        if (empty($ip))$ip = $request->ip();
        return $ip;
    }
	
    public static function alternativeAddress($ip, $id){
        $query = IPAPI::query($ip);
        if ($query->status == "success") {
            $country_name = $query->country;
            $lat = $query->lat;
            $lon = $query->lon;
            $city = $query->city;
            $country_code = $query->countryCode;
            $find_country = Country::where('shortname', $country_code)->first();
            $country_id = 0;
            if ($find_country) {
                $country_id = $find_country->id;
            } else {
                $country = new Country();
                $country->name = $country_name;
                $country->shortname = $country_code;
                if ($country->save()) {
                    $country_id = $country->id;
                }
            }
            $city_id = 0;
            if ($country_id > 0) {
                $find_city = City::where('name', $city)->where('country_id', $country_id)->first();
                if ($find_city) {
                    $city_id = $find_city->id;
                } else {
                    $city = new City();
                    $city->name = $city;
                    $city->zip = "1";
                    $city->country_id = $country_id;
                    if ($city->save()) {
                        $city_id = $city->id;
                    }
                }
            }
            if (!empty($lat) && !empty($lon) && !empty($city) && !empty($country_code) && !empty($city_id) && !empty($country_id)) {
                self::updateLocation($id, $city_id, $lat, $lon, $city);
            }
        }
    }
    
	
}