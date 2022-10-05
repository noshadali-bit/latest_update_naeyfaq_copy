<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_file extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'product_file';
    protected $guarded = [];
    protected $appends = ['image_url'];

    // public function cat_id(){
    // 	return $this->belongsTo('App\Models\category', 'cat_id' , 'id');
    // }
    public function getImageUrlAttribute(){
        return asset('uploads/products/'.$this->product_id.'/'.$this->file);
    }
}
