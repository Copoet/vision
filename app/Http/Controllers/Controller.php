<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\Common\CodeService;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    const RETURN_CODE = 'code';

    const RETURN_MSG = 'msg';

    const RETURN_DATA = 'data';

    const RETURN_STATUS = 'status';

    /**
     * 获取信息提示
     * @param bool $code
     * @param bool $msg
     * @param bool $defaultType
     * @return bool
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/4:45 PM
     */
    public function getCodeMsg($code = false, $msg = false, $defaultType = false)
    {

        $msgConfig = CodeService::$config;

        if (empty($msg)) {
            if (!empty($msgConfig[$code])) {

                $msg = $msgConfig[$code];
            } else {

                if ($defaultType == false) {

                    $msg = $msgConfig[CodeService::PUBLIC_ERROR];

                } else {

                    $msg = $msgConfig[CodeService::PUBLIC_SUCCESS];
                }
            }
        }

        return $msg;
    }


    /**
     * 返回错误提示
     * @param int $code
     * @param null $msg
     * @param array $data
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/4:46 PM
     */
    public function returnFail($code = 1000, $msg = NULL, $data = array())
    {
        $msg  = $this->getCodeMsg((int)$code, $msg);
        $data = empty($data) ? $data : $data;

        $param = array(
            self::RETURN_CODE   => $code,
            self::RETURN_MSG    => $msg,
            self::RETURN_STATUS => false,
            self::RETURN_DATA   => $data
        );

        exit(json_encode($param));
    }


    /**
     * 统一成功返回提示
     * @param array $data
     * @param int $code
     * @param null $msg
     * @return \Illuminate\Http\JsonResponse
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/5:00 PM
     */
    public function returnSuccess($data = array(), $code = 2000, $msg = NULL)
    {
        $msg  = $this->getCodeMsg((int)$code, $msg);
        $data = empty($data) ? $data : $data;
        $param = array(
            self::RETURN_CODE   => $code,
            self::RETURN_MSG    => $msg,
            self::RETURN_STATUS => true,
            self::RETURN_DATA   => $data
        );
        exit(json_encode($param));
    }


}
