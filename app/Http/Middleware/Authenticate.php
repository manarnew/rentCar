<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
      if (! $request->expectsJson()) {
        if($request->is('admin')||$request->is('admin/*')){
     //redirect to admin login
return route('admin.login');
        }else{
//redirect to fron login in case there is front 
//return route('login');
return route('admin.login');

        } 

    }
    }
}
