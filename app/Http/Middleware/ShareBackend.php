<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use Setting;

class ShareBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $onuser = Auth::user();
            View::share( 'onuser', $onuser );
        }
        $settings = Setting::all();
        View::share( 'settings', $settings );

        return $next($request);
    }

}