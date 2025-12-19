<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);
        
        if (in_array($locale, ['es', 'en'])) {
            app()->setLocale($locale);
            $request->attributes->set('locale', $locale);
        } else {
            app()->setLocale('es');
            $request->attributes->set('locale', 'es');
        }

        view()->share('locale', app()->getLocale());

        return $next($request);
    }
}
