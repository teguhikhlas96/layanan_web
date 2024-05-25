<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next)
    {   
       // Periksa apakah token ada dalam sesi atau cookie
       $token = $request->session()->get('api_token');
        
        //validasi token
        

       if (!$token) {
           // Jika token tidak ada, pengguna belum terautentikasi
           return redirect()->route('login');
       }

        return $next($request);
    }
}
