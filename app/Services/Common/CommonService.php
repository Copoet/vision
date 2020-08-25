<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/2:15 PM
 */

namespace App\Services\Common;

use Webpatser\Uuid\Uuid;

class CommonService
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


    /**
     * 树形结构获取
     * @param $data
     * @param $pid
     * @return array|string
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/5:04 PM
     */
    public static function getTree($data, $pid)
    {
        $tree = [];
        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $pid) {

                $v['children'] = self::getTree($data, $v['id']);
                $tree[]        = $v;
            }
        }

        return $tree;
    }


    /**
     * 返回数据格式化
     * @param $array
     * @return array
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/5:02 PM
     */
    public static function arrayFormat($array)
    {
        $newArr = array();
        if (!is_array($array)) {
            return $array;
        }
        foreach ($array as $key => $val) {
            if (!is_array($val)) {
                $newArr[$key] = ucwords(str_replace('_', ' ', $val));
            } else {
                $array[$key] = self::arrayFormat($val);
                $newArr[]    = $val;
            }
        }

        return $newArr;

    }
}