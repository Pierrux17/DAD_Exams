<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckExamStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');
        $exam = Exam::where('token', $token)->first();

        if (!$exam || !in_array($exam->status, ['En attente', 'En cours'])) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas accéder à cet examen.');
        }

        return $next($request);
    }
}
