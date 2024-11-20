<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirection
{
    private string $requiredRole;

    public function __construct(string $requiredRole)
    {
        $this->requiredRole = $requiredRole;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->role === $this->requiredRole) {
            return redirect('/login')->withErrors(['access' => 'Access denied.']);
        }

        return $next($request);
    }
}
