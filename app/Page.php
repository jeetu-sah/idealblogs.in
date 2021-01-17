<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Page extends Model{
    
	protected $table =  "pages";
    protected $fillable = ['id' , 'parent_id'  , 'page_slug' , 'page_name','priority', 'status', 'page_title', 'meta_key_word' , 'meta_description', 'private_status' , 'deleted_at', 'created_at' , 'updated_at'
    ];
}
