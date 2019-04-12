<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use function var_dump;


class AuthenticateAccess

{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validSecrects = explode(',', env('ACCEPTED_SECRETS'));

        if (in_array($request->header('Authorization'), $validSecrects)) {
            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}
