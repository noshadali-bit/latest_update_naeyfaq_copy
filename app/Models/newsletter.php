<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class newsletter extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'newsletter';
    protected $guarded = [];  
    
    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
