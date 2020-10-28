<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $service;


    public function __construct(EmailTemplateService $service)
    {
        $this->service = $service;
    }


    /**
     * templateList
     * @param Request $request
     */
    public function templateList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->service->getList($param, '*', $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * createTemplate
     * @param Request $request
     *
     */
    public function createTemplate(Request $request)
    {
        $name       = $request->input('username');
        $smtp       = $request->input('smtp');
        $password   = $request->input('password');
        $status     = $request->input('status');
        $port       = $request->input('port');
        $is_default = $request->input('id_default');


        if (empty($name) || empty($content) || empty($status)) {

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
     * updateTemplate
     * @param Request $request
     */
    public function updateTemplate(Request $request)
    {
        $name       = $request->input('username');
        $smtp       = $request->input('smtp');
        $password   = $request->input('password');
        $status     = $request->input('status');
        $port       = $request->input('port');
        $is_default = $request->input('id_default');
        $id         = $request->input('id');

        if (empty($name) || empty($content) || empty($status)) {

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
     * delTemplate
     * @param Request $request
     *
     */
    public function delTemplate(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $result = $this->service->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}