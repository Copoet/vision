<?php
/**
 * Created by PhpStorm.
 * Author: copoet
 * Mail: copoet@126.com
 * Date: 2020/8/11/2:27 PM
 */

namespace App\Services\Common;


class CodeServices
{

    //参数类
    const PUBLIC_ERROR = 1000;
    const PUBLIC_SUCCESS = 2000;
    const PUBLIC_PARAMS_NULL = 2001;
    const PUBLIC_LOGIN_ERROR = 2002;
    const PUBLIC_EXPORT_EMPTY = 2003;
    const PUBLIC_PARAMS_ILLEGAL = 2004;
    const PUBLIC_PARAMS_ALREADY_EXIST = 2005;
    const PUBLIC_PARAMS_LACK = 2006;
    const PUBLIC_USERNAME_ALREADY_EXIST = 2007;
    const PUBLIC_PHONE_ALREADY_EXIST = 2008;
    const PUBLIC_EMAIL_ALREADY_EXIST = 2009;
    //短信类
    const MESSAGE_TAG_ERROR = 3001;
    const MESSAGE_FORMAT_ERROR = 3002;
    const MESSAGE_TEMPLETS_ERROR = 3003;
    const MESSAGE_TEMPLETS_PARAM_ERROR = 3004;
    const MESSAGE_TIMESTAMP_ERROR = 3005;

    //权限类
    const PUBLIC_AUTH_ERROR = 4000;
    const PUBLIC_AUTH__ALREADY_EXIST = 4001;
    //身份类
    const PUBLIC_TOKEN_ERROR = 5000;
    const PUBLIC_SIGN_ERROR = 5001;
    //请求类
    const PUBLIC_OTHER_HTTP_ERROR = 6001;



    public static $config = array
    (
        //参数类
        self::PUBLIC_SUCCESS => '处理成功',
        self::PUBLIC_ERROR => '处理失败',
        self::PUBLIC_PARAMS_NULL => '操作参数为空',
        self::PUBLIC_LOGIN_ERROR => '登陆失败，账号或密码错误',
        self::PUBLIC_PARAMS_ILLEGAL => '参数非法',
        self::PUBLIC_PARAMS_ALREADY_EXIST => '数据已存在',
        self::PUBLIC_PARAMS_LACK => '缺少参数',
        self::PUBLIC_USERNAME_ALREADY_EXIST => '用户名已存在',
        self::PUBLIC_PHONE_ALREADY_EXIST => '手机号已存在',
        self::PUBLIC_EMAIL_ALREADY_EXIST => '邮箱已存在',
        //短信类
        self::MESSAGE_TAG_ERROR => '消息错误',
        self::MESSAGE_FORMAT_ERROR => '格式错误',
        self::MESSAGE_TEMPLETS_ERROR => '模板id错误',
        self::MESSAGE_TEMPLETS_PARAM_ERROR => '缺少模板参数',
        self::MESSAGE_TIMESTAMP_ERROR => '时间过期',
        //权限类
        self::PUBLIC_AUTH_ERROR => '权限错误',
        self::PUBLIC_AUTH__ALREADY_EXIST => '权限已存在',
        //身份类
        self::PUBLIC_SIGN_ERROR => 'sign错误',
        self::PUBLIC_TOKEN_ERROR => '请求token错误',
        //http请求类
        self::PUBLIC_OTHER_HTTP_ERROR => '系统内部请求网络错误',//第三方请求网络
    );


}