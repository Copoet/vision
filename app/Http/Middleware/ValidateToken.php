<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Common\CodeService;

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


        $result = auth()->check($request);

        if (!$result) {

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
