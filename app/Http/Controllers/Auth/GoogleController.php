<?php
  
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function redirectToGoogle()
      {
       $parameters = [
            'access_type' => 'offline',
            'approval_prompt' => 'force'
        ];
    return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
    }
     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
      {

       $data = [
            'token' => $auth_user->token,
            'expires_in' => $auth_user->expiresIn,
            'name' => $auth_user->name
        ];

        if($auth_user->refreshToken){
            $data['refresh_token'] = $auth_user->refreshToken;
        }

        $user = User::updateOrCreate(
            [
                'email' => $auth_user->email
            ],
            $data
        );

        Auth::login($user, true);
        return redirect()->to('/'); // Redirect to a secure page
    }
     public function dropbox()
      {


     return Socialite::driver('dropbox')->redirect();
     }

     // for microsoft one drive
      public function redirectToProvider()
       {
        return Socialite::with('graph')->redirect();

      }

    /**
     * Obtain the user information from graph.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::with('graph')->user();

        // $user->token;
    }
}
