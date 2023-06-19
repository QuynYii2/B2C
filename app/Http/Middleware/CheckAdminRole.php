<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $roleUsers = DB::table('role_user')->where('user_id',  Auth::user()->id)->get();
            foreach ($roleUsers as $roleUser){
                $role = DB::table('roles')->where('id',  $roleUser->role_id)->first();
                if ($role->name == Role::ADMIN){
                    return $next($request);
                }
            }
        }

        abort(403, 'Unauthorized');
    }
}
