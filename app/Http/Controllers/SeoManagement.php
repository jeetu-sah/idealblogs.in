<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Blogs , App\User , App\SeoModel;
use Mail;
use App\Mail\ContactMail;
use Auth;
use sHelper;
use DB;


class SeoManagement extends Controller
{
    public function saveUrl(){
		
        $validatedData = request()->validate([
            'url' =>'required', 'title' =>'required',
            'meta_keyword'=>'required','meta_description'=>'required'
        ]);
		$url = trim(request()->url);
        $response = SeoModel::updateOrcreate(['page_url'=>$url] ,
                                 [
                                    'page_url'=>$url,
                                    'page_title'=>request()->title,
                                    'meta_key_word'=>request()->meta_keyword,
                                    'meta_description'=>request()->meta_description
                                 ]);
        if($response){
            return redirect()->back()->with(["msg"=>'<div class="notice notice-success">
									<strong>Success </strong>Record Save successfully   !!!.</div>.']); 
        }
        else{
              return redirect()->back()->with(["msg"=>'<div class="notice notice-danger">
									<strong>Wrong </strong> Something went wrong , please try again  !!!.</div>.']); 
        }
       
    }

    public function urlList(Request $request){
        $limit = request()->input('length');
		$start = request()->input('start');
		$columns = array(0=>'id' , 1=>'f_name', 2=>'mobile', 3=>'name');
		$dir = $request->input('order.0.dir');
		if($dir == "asc"){ $dir = "ASC"; }
		else{ $dir = "DESC"; }
		$order = $columns[$request->input('order.0.column')];
		$postQuery = SeoModel::where([['deleted_at','=',NULL],])->orderBy('id','DESC');
		$totalRecord = $postQuery->count();
		$posts = $postQuery->skip($start)->take($limit)->get();
        $partners_lists = [];
		if($posts->count() > 0){
			$i = 1;
			foreach($posts as $post){
				$change_credential = NULL;	
				$delete_btn =  "<a href='javascript::void()' data-partnerid='".$post->id."' data-toggle='tooltip' title='Add category' class='btn btn-danger remove_partner' style='margin-right: 5px;'><i class='fas fa-trash'></i></a>&nbsp;";
				$edit_btn = '<a href="'.url("dashboard/edit-url/".$post->id).'" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
				<i class="fas fa-edit"></i> 
				</a>';	
				$postArr = [];
				$postArr['sn'] = $post->id;
				$postArr['title'] = $post->page_url;
				$postArr['action'] = $delete_btn.' '.$edit_btn." ".$change_credential;
				$i++;
				$partners_lists[] = $postArr;
			}
		}

		$json_data = array(
			"draw"            => intval(request()->input('draw')),  
			"recordsTotal"    => intval($totalRecord),  
			"recordsFiltered" => intval($totalRecord), 
			"data"            => $partners_lists   
		);
        return json_encode($json_data); exit;
	}
}
