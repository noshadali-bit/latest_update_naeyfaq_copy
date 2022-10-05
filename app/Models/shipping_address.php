<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shipping_address extends Model
{
 	  protected $primaryKey = 'id';
  	protected $table = 'shipping_address';
    protected $guarded = [];  

    // public function cat_id(){
    // 	return $this->belongsTo('App\Models\category', 'cat_id' , 'id');
    // }
}
