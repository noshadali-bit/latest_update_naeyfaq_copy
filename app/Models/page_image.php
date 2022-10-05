<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class page_image extends Model
{
    protected $table = 'page_images';
	public $primaryKey = 'id';
    protected $fillable = [
    	'product_id','name','file','desc','position','is_active','is_deleted'
    ];
    // public function product_id(){
    // 	return $this->belongsTo('App\Models\product', 'product_id' , 'id');
    // }
}
