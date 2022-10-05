<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog_comment extends Model
{
 	  protected $primaryKey = 'id';
  	protected $table = 'blog_comment';
    protected $guarded = [];  

    // public function cat_id(){
    // 	return $this->belongsTo('App\Models\category', 'cat_id' , 'id');
    // }
}
