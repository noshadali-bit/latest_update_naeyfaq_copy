<?php 
use App\Models\jobs;
use App\Models\save_job;
use Illuminate\Support\Facades\Auth;
  function saved_job($id){
  
   if(!Auth::user())
        {
           $user=Null;
         

        }else{
   return save_job::where('job_id',$id)->where('user_id',Auth::user()->id)->first();
    }
     
    }

  
 








 




