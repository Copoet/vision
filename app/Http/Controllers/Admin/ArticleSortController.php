<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\ArticleSortService;
use App\Services\Common\CodeService;
use Illuminate\Http\Request;

class ArticleSortController extends Controller
{
    protected $sortService;


    public function __construct(ArticleSortService $service)
    {
        $this->sortService = $service;
    }


    /**
     * 获取分类列表
     * @param Request $request
     */
    public function articleSortList(Request $request)
    {
        $page     = $request->input('page') ? $request->input('page') : 1;
        $pageSize = $request->input('page_size') ? $request->input('page_size') : 20;
        $param    = $request->all();

        $list = $this->sortService->getSortList($param, ['*','status as status_str','is_delete as is_delete_str'], $page, $pageSize);

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 新增文章分类
     * @param Request $request
     *
     */
    public function createArticleSort(Request $request)
    {
        $name        = $request->input('sort_name');
        $sortId      = $request->input('parent_id');
        $status      = $request->input('status');
        $keywords    = $request->input('keywords');
        $description = $request->input('description');

        if (empty($name)  || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['sort_name']   = $name;
        $data['parent_id']   = $sortId;
        $data['status']      = $status;
        $data['keywords']    = $keywords;
        $data['description'] = $description;

        $result = $this->sortService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 更新文章分类
     * @param  int $id
     * @param Request $request
     */
    public function updateArticleSort(int $id,Request $request)
    {
        $name        = $request->input('sort_name');
        $sortId      = $request->input('parent_id');
        $status      = $request->input('status');
        $keywords    = $request->input('keywords');
        $description = $request->input('description');

        if (empty($name)  || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['sort_name']   = $name;
        $data['parent_id']   = $sortId;
        $data['status']      = $status;
        $data['keywords']    = $keywords;
        $data['description'] = $description;

        $result = $this->sortService->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 删除分类
     * @param int $id
     *
     */
    public function delArticleSort(int $id)
    {

        $result = $this->sortService->del(['id' => $id]);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * @param Request $request
     */
    public function getSortTree(Request $request)
    {

        $list = $this->sortService->getSortTree();

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }
}
