<?php
namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller{

	
	public function login(){
	   return view('login');
	}
	public function loginnew(){
	   return view('adminPages.login');
	}
	
	public function sign_up(){
	  return view('sign_up');
	}
	
	
	public function logout(){
	   Auth::logout();
	   return redirect('/');
	}
	
	public function signup_post(Request $request){
	   $request->validate([
          'mobile' =>'required','password'=>'required','confirm_password'=>'required'
       ]);
	   if($request->password == $request->confirm_password) {
            $user_response = User::create(['name'=>$request->name , 'mobile'=>$request->mobile,'password'=>Hash::make($request->password)]);
			if($user_response != NULL){
			    $remember = $request->remember_me;
                Auth::login($user_response , $remember);
                return redirect('js_admin')->with(['msg'=>'<div class="notice notice-success"><strong> Success , </strong> Login Successful  !!! . </div>']);  
			   }
			else{
			    return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong> Something went wrong , please try again  !!! . </div>']);
			   }   
             }
           else{
              return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong> Password does not matched !!! . </div>']); 
             } 
	}
	
	public function login_post_action(Request $request){
	   $request->validate([
          'mobile' =>'required','password'=>'required'
         ]);
		 
       $user_details = \App\User::where([['mobile','=' , $request->mobile]])->first();
       if($user_details != NULL){
           //if($request->password == $user_details->password) {
        if(Hash::check($request->password , $user_details->password)){
               $remember = $request->remember_me;
                Auth::login($user_details , $remember);
                return redirect('js_admin')->with(['msg'=>'<div class="notice notice-success"><strong> Success , </strong> Login Successful  !!! . </div>']);    
             }
           else{
              return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong> Password does not matched !!! . </div>']); 
             }  
         }
       else{
            return redirect()->back()->with(['msg'=>'<div class="notice notice-danger"><strong> Wrong , </strong> User does not exists with this crediantial !!! . </div>']);
         }  	
	}
	
}
