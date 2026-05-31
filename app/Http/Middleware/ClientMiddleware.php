<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
  
  
    public function handle(Request $request, Closure $next)  {


        if(auth()->user()->role !== 'client'){
            return redirect()->route('dashboard');
        }
        
        return $next($request);
    }
}
