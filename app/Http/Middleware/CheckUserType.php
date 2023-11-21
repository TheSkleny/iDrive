<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;


class CheckUserType
{
    public function handle(Request $request, Closure $next, $userType)
    {
        $user = auth()->user();

        if ($user && $user->type->Id == $userType) {
            return $next($request);
        }
        // Redirect the user to a specific route or return a response indicating they are not authorized
        return redirect()->route('welcome');
    }
}