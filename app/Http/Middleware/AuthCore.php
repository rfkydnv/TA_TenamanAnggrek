<?php

namespace App\Http\Middleware;

use Closure;
use AppCoreHelper;
use Auth;

class AuthCore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $roleDetail = AppCoreHelper::granted(Auth::User()->user_role_id);

        $prefix = $request->route()->getPrefix();
        $slash = substr($prefix, 0, 1);
        if ($slash == "/") {
            $prefix = substr($prefix, 1);
        }
        if (!array_key_exists($prefix, session('menu_access'))) {
            return abort(401, 'Maaf, anda tidak diizinkan mengakses halaman ini.');
        }
        return $next($request);
    }
}
