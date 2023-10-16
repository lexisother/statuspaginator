<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->get('token');
        if ($token !== env('STATUSPAGINATOR_TOKEN')) {
            return response('Incorrect token', 403);
        }

        return $next($request);
    }
}
