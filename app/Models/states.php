<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class states extends Model
{
    protected $table = 'states';
	public $primaryKey = 'id';
    protected $fillable = [
    	'is_active','is_deleted'
    ];
}
