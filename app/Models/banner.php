<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
  protected $table = 'banner';
  public $primaryKey = 'id';
  protected $fillable = [
     'file','is_active','is_deleted'
  ];
}
