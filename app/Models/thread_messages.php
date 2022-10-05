<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use App\Models\User;



class thread_messages extends Model

{

    protected $table = 'thread_messages';

    public $primaryKey = 'id';

    protected $fillable = [

        'user_id', 'is_deleted', 'is_active',

    ];

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id', 'id');
    }

    public function receiver_user($id)
    {
        return User::where("id", $id)->where("is_active", 1)->first();
    }
}
