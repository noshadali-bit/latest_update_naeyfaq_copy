<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
 	  protected $primaryKey = 'id';
  	protected $table = 'orders';
    protected $guarded = [];  

    // public function cat_id(){
    // 	return $this->belongsTo('App\Models\category', 'cat_id' , 'id');
    // }
}
