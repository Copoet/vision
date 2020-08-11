<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/2:15 PM
 */

namespace App\Services\Common;

use Webpatser\Uuid\Uuid;

class CommonServices
{

    /**
     * 获取uuid
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:15 PM
     */
    public static function getUuid()
    {
        return str_replace('-', '', Uuid::generate());
    }


    /**
     * @param $userName 用户名
     * @param $passWord 密码
     * @return string
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:17 PM
     */
    public static function generatePass($userName, $passWord)
    {
        return md5(md5($userName) . sha1($passWord));
    }


    /**
     *
     * 生成token
     * @return string
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:17 PM
     */
    public static function generateToken()
    {
        return sha1(str_replace('-', '', Uuid::generate()));
    }

}