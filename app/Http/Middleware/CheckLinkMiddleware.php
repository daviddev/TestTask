<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckLinkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->key) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => __('auth.permission_denied')
                ], 403);
            }
            return redirect()->route('error');
        }
        return $next($request);
    }
}
