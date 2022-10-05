<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
  protected $table = 'categories';
  public $primaryKey = 'id';
  protected $fillable = [
     'name','description','file','is_active','is_deleted'
  ];
}
