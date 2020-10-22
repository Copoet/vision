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

        $list = $this->sortService->getSortList($param, '*', $page, $pageSize);

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
        $name        = $request->input('title');
        $sortId      = $request->input('sort_id');
        $titlePic    = $request->input('titlepic');
        $status      = $request->input('status');
        $content     = $request->input('content');
        $keywords    = $request->input('keywords');
        $description = $request->input('description');
        $flag        = $request->input('flag');

        if (empty($name) || empty($content) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']       = $name;
        $data['sort_id']     = $sortId;
        $data['titlepic']    = $titlePic;
        $data['status']      = $status;
        $data['content']     = $content;
        $data['keywords']    = $keywords;
        $data['description'] = $description;
        $data['flag']        = $flag;

        $result = $this->sortService->store($data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }
    }


    /**
     * 更新文章分类
     * @param Request $request
     */
    public function updateArticleSort(Request $request)
    {
        $name        = $request->input('title');
        $sortId      = $request->input('sort_id');
        $titlePic    = $request->input('titlepic');
        $status      = $request->input('status');
        $content     = $request->input('content');
        $keywords    = $request->input('keywords');
        $description = $request->input('description');
        $flag        = $request->input('flag');
        $id          = $request->input('id');

        if (empty($id) || empty($name) || empty($url) || empty($status)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

        $data['title']       = $name;
        $data['sort_id']     = $sortId;
        $data['titlepic']    = $titlePic;
        $data['status']      = $status;
        $data['content']     = $content;
        $data['keywords']    = $keywords;
        $data['description'] = $description;
        $data['flag']        = $flag;

        $result = $this->sortService->update(['id' => $id], $data);

        if ($result) {
            $this->returnSuccess($result);
        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }

    }

    /**
     * 删除分类
     * @param Request $request
     *
     */
    public function delArticleSort(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {

            $this->returnFail(CodeService::PUBLIC_PARAMS_NULL);
        }

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
    public function getSortTree(Request $request){


        $list = $this->sortService->getSortTree();

        if ($list) {

            $this->returnSuccess($list, CodeService::PUBLIC_SUCCESS);

        } else {
            $this->returnFail(CodeService::PUBLIC_ERROR);
        }


    }
}