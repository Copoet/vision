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
    public function handle($request, Closure $next)
    {
        $token = $request->input('token');
        if (empty($token)) {
            return Response()->json(CodeService::PUBLIC_PARAMS_NULL);
        }

        $manager     = new ManagerService();
        $checkResult = $manager->checkManagerToken($token);
        if (empty($checkResult)) {
            return Response()->json([
                'code'   => CodeService::PUBLIC_TOKEN_ERROR,
                'msg'    => '请重新登录',
                'status' => false,
                'data'   => ''
            ]);
        }

        return $next($request);
    }

}
