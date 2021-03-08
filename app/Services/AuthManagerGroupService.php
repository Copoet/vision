<?php


namespace App\Services;


use App\Models\AuthManagerGroup;

class AuthManagerGroupService
{

    /**
     * 获取单条信息
     * @param $where
     * @param array $columns
     * @return array
     *
     */
    public function getInfo($where, $columns = ['*'])
    {

        return AuthManagerGroup::query()->where($where)
            ->get($columns)
            ->toArray();

    }


    /**
     * 列表
     * @param $where
     * @param array $columns
     * @param $page
     * @param $pageSize
     * @return mixed
     * @author copoet
     * @mail copoet@126.com
     * Date: 2020/8/22/5:28 PM
     */
    public function getList($where, $columns = ['*'], $page, $pageSize)
    {

        $result['total'] = AuthManagerGroup::query(function ($query) use ($where) {
            if (isset($where['keyword'])) {
                $query->where('name', 'like', '%' . $where['keyword'] . '%');
            }
        })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = AuthManagerGroup::query()->where(function ($query) use ($where) {
            if (isset($param['keyword'])) {
                $query->where('name', 'like', '%' . $where['keyword'] . '%');
            }
        })
            ->offset($offset)
            ->limit($pageSize)
            ->get($columns);

        return $result;

    }



    /**
     * 添加
     * @param $param
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     *
     */
    public function store($param)
    {
        return AuthManagerGroup::query()->create($param);
    }

    /**
     * 删除操作
     * @param $where
     * @return int
     *
     */
    public function del($where)
    {

        return AuthManagerGroup::query()->where($where)->update(['id_delete' => 2]);

    }


    /**
     * 更新操作
     * @param $where
     * @param $param
     * @return int
     *
     */
    public function update($where, $param)
    {

        return AuthManagerGroup::query()->where($where)->update($param);
    }
}
