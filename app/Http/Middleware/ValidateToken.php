<?php

namespace App\Http\Middleware;

use Closure;

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
            $result['code'] = '4001';
            $result['status'] = false;
            $result['msg'] = '操作参数不能为空';
            return Response()->json($result);
        }
        $checkResult = ManagerModel::checkManagerToken($token);
        if (empty($checkResult)) {
            $result['code'] = '4001';
            $result['status'] = false;
            $result['msg'] = 'token不合法';
            return Response()->json($result);
        }
//        if ((time() - 86400) > $checkResult->last_time) {
//            $result['code'] = '4001';
//            $result['status'] = false;
//            $result['msg'] = '会话过期,请重新登录';
//            return Response()->json($result);
//        }
        return $next($request);
    }

}
