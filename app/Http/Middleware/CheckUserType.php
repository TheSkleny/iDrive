<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Enums\UserTypeEnum;


class CheckUserType
{
    public function handle(Request $request, Closure $next, int $userType)
    {
        $user = auth()->user();

        // if user is admin he can get anywhere
        if ($user && $user->type->Id == UserTypeEnum::ADMIN) {
            return $next($request);
        }

        if ($user && $user->type->Id == $userType) {
            return $next($request);
        }
        // Redirect the user to a specific route or return a response indicating they are not authorized
        return redirect()->route('search-line');
    }
}
