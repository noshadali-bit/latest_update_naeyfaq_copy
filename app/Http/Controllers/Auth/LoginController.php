<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\reviews;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';
    protected function redirectTo()
    {
        if(Auth::user()->is_active == 0){

            Auth::logout();
            return '/signin?error=Account Not Activated. kindly Verify your account email address';

        }

        if(Auth::user()->role_id == 1){
            return '/user-profile';
        }else if(Auth::user()->role_id == 4){
            return '/user-profile';
        }

        if(Session::has('review_id')){
            $review_id = Session::get('review_id');
            $review_feilds['user_id'] = Auth::user()->id;
            $review_feilds['is_confirm'] = 1;
            $reviews_data = reviews::where('id', $review_id)->first();
            if (isset($reviews_data)&& $reviews_data->step_filled==2) {
            $reviews = reviews::where('id', $review_id)->update($review_feilds);
            Session::forget('review_id');
            return '/welcome?message=Youe review details has been saved';
            }
        }
        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


}
