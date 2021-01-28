<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model{
    
    use SoftDeletes;

	protected $table =  "pages";
    protected $fillable = ['id' , 'parent_id'  , 'page_slug' , 'page_name','priority', 'status', 'page_title', 'meta_key_word' , 'meta_description', 'private_status' , 'deleted_at', 'created_at' , 'updated_at'
    ];
}
