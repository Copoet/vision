<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $service;


    public function __construct(EmailService $service)
    {
        $this->service = $service;
    }


    /**
     * emailList
     * @param Request $request
     */
    public function emailList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->service->getList($param, ['*', 'status as status_str', 'is_delete as is_delete_str'], $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

    /**
     * 邮箱详情
     * @param $id
     */
    public function emailInfo(int $id)
    {
        if (empty($id)) {
            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data = $this->service->getInfo(['id' => $id]);

        if ($data) {

            $this->returnSuccess($data, CodeService::PUBLIC_SUCCESS);
        } else {

            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * createEmail
     * @param Request $request
     *
     */
    public function createEmail(Request $request)
    {
        $name       = $request->input('username');
        $smtp       = $request->input('smtp');
        $password   = $request->input('password');
        $status     = $request->input('status');
        $port       = $request->input('port');
        $is_default = $request->input('id_default');


        if (empty($name) || empty($password) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['username']   = $name;
        $data['smtp']       = $smtp;
        $data['password']   = $password;
        $data['status']     = $status;
        $data['port']       = $port;
        $data['is_default'] = $is_default;


        $result = $this->service->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * @param int $id
     * @param Request $request
     */
    public function updateEmail(int $id, Request $request)
    {
        $name       = $request->input('username');
        $smtp       = $request->input('smtp');
        $password   = $request->input('password');
        $status     = $request->input('status');
        $port       = $request->input('port');
        $is_default = $request->input('id_default');

        if (empty($name) || empty($password) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['username']   = $name;
        $data['smtp']       = $smtp;
        $data['password']   = $password;
        $data['status']     = $status;
        $data['port']       = $port;
        $data['is_default'] = $is_default;


        $result = $this->service->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }


    /**
     * delEmail
     * @param int $id
     */
    public function delEmail(int $id)
    {
        $result = $this->service->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}
