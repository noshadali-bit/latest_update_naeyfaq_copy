<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use myPHPnotes\Microsoft\Auth;
use Illuminate\Http\RedirectResponse;
use myPHPnotes\Microsoft\Models\User;

class MicrosoftController extends Controller
{
    public function microsoft_login(){
        $tenant = env('microsoft_tenant');
        $client_id = env('microsoft_client_id');
        $client_secret = env('microsoft_client_secret');
        $callback = env('microsoft_callback');
        $scope = ['User.Read'];
        $microsoft = new Auth($tenant, $client_id, $client_secret, $callback, $scope);
        return new RedirectResponse($microsoft->getAuthUrl());
        // return Redirect::to($microsoft->getAuthUrl());
        // var_dump($microsoft->getAuthUrl());
    }
    public function microsoft_callback(){
        $tenant = env('microsoft_tenant');
        $client_id = env('microsoft_client_id');
        $client_secret = env('microsoft_client_secret');
        $callback = env('microsoft_callback');
        $scope = ['User.Read'];
        $auth = new Auth($tenant, $client_id, $client_secret, $callback, $scope);
        $tokens = $auth->getToken($_GET['code']);
        // dd($tokens);
        $accessToken = $tokens->access_token;

        $auth->setAccessToken($accessToken);
        $user = new User;
        // dd($user->data);
        $email = $user->data->getProperties()['userPrincipalName'];
        $name = $user->data->getProperties()['displayName'];
        if ($name == null) {
            $name = $email;
        }
        return redirect()->route('check_login',[$email,$name]);
    }
}
