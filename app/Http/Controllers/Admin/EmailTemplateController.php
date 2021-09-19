<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Common\CodeService;
use App\Services\EmailTemplateService;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    protected $service;


    public function __construct(EmailTemplateService $service)
    {
        $this->service = $service;
    }


    /**
     * 获取
     * @param Request $request
     */
    public function templateList(Request $request)
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
     * @param Request $id
     */
    public function templateInfo(int $id)
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
     * 新增
     * @param Request $request
     *
     */
    public function createTemplate(Request $request)
    {
        $name    = $request->input('title');
        $status  = $request->input('status');
        $content = $request->input('content');

        if (empty($name) || empty($content) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']   = $name;
        $data['status']  = $status;
        $data['content'] = $content;

        $result = $this->service->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 更新
     * @param Request $request
     * @param int $id
     */
    public function updateTemplate(int $id, Request $request)
    {
        $name    = $request->input('title');
        $status  = $request->input('status');
        $content = $request->input('content');
        if (empty($name) || empty($content) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']   = $name;
        $data['status']  = $status;
        $data['content'] = $content;


        $result = $this->service->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 删除
     * @param int $id
     *
     */
    public function delTemplate(int $id)
    {

        $result = $this->service->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }

}
