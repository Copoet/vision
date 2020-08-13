<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Common\CodeService;
use App\Services\ManagerService;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next,ManagerService $mananger)
    {
        $token = $request->input('token');
        if (empty($token)) {
            return Response()->json(CodeService::PUBLIC_PARAMS_NULL);
        }
        $checkResult = $mananger->checkManagerToken($token);

        if (empty($checkResult)) {
            return Response()->json(CodeService::PUBLIC_TOKEN_ERROR);
        }
        return $next($request);
    }

}
