<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
 	  protected $primaryKey = 'id';
  	protected $table = 'orders_items';
    protected $guarded = [];  

    // public function cat_id(){
    // 	return $this->belongsTo('App\Models\category', 'cat_id' , 'id');
    // }
}
