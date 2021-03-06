<?php

namespace Pluma\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AuthenticateAdmin
{
    /**
     * The redirect route for guests.
     * @var string
     */
    protected $redirectGuest = 'admin/login';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( Auth::guard( $guard )->guest() ) {
            if ( $request->ajax() || $request->wantsJson() ) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest( $this->redirectGuest );
        }

        return $next( $request );
    }
}
