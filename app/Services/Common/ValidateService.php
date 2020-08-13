<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/2:27 PM
 */

namespace App\Services\Common;


class ValidateService
{

    /**
     * 手机号格式验证
     * @param $phone
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:32 PM
     */
    public static function validatePhone($phone)
    {

        if ($phone == '') {
            $result['code']   = '001';
            $result['status'] = false;
            $result['msg']    = '手机号不能为空';

            return $result;
        }
        $pattern = '/^(13[0-9]|14[0-9]|17[0-9]|15[0|3|6|7|8|9]|18[0-9])\d{8}$/';
        if (!preg_match($pattern, $phone)) {
            $result['code']   = '002';
            $result['status'] = false;
            $result['msg']    = '手机号不符合规则';

            return $result;
        }
        $result['status'] = true;

        return $result;

    }

    /**
     * 邮箱格式验证
     * @param $email
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:33 PM
     */
    public static function validateEmail($email)
    {

        if ($email == '') {
            $result['code']   = '003';
            $result['status'] = false;
            $result['msg']    = '邮箱不能为空';

            return $result;
        }
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (!preg_match($pattern, $email)) {
            $result['cdoe']   = '004';
            $result['status'] = false;
            $result['msg']    = '邮箱不合法';

            return $result;
        }
        $result['status'] = true;

        return $result;


    }


    /**
     * 身份证格式校验
     * @param $cardId
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:35 PM
     */
    public static function validateCardId($cardId)
    {
        if ($cardId == '') {
            $result['code']   = '004';
            $result['status'] = false;
            $result['msg']    = '身份证号不能为空';

            return $result;
        }
        $pattern = '/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/';
        if (!preg_match($pattern, $cardId)) {
            $result['code']   = '005';
            $result['status'] = false;
            $result['msg']    = '邮箱不合法';

            return $result;
        }
        $result['status'] = true;

        return $result;

    }


    /**
     * 银行卡号校验
     * @param $cardNumber
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/11/2:36 PM
     */
    public static function validateCardNumber($cardNumber)
    {
        if ($cardNumber == '') {
            $result['code']   = '006';
            $result['status'] = false;
            $result['msg']    = '卡号不能为空';

            return $result;
        }
        $pattern = '/^(\d{16}|\d{19})$/';
        if (!preg_match($pattern, $cardNumber)) {
            $result['code']   = '007';
            $result['status'] = false;
            $result['msg']    = '银行卡格式错误';

            return $result;
        }
        $result['status'] = true;

        return $result;

    }

}