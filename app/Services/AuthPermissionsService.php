<?php


namespace App\Services;


use App\Models\AuthPermissions;

class AuthPermissionsService
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

        return AuthPermissions::query()->where($where)
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
     */
    public function getList($where, $columns = ['*'], $page, $pageSize)
    {

        $result['total'] = AuthPermissions::query()->where(function ($query) use ($where) {
            if (isset($where['keyword'])) {
                $query->where('name', 'like', '%' . $where['keyword'] . '%');
            }
        })->count();

        $offset = ($page - 1) * $pageSize;

        $result['list'] = AuthPermissions::query()->where(function ($query) use ($where) {
            if (isset($where['keyword'])) {
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
        return AuthPermissions::query()->create($param);
    }

    /**
     * 删除操作
     * @param $where
     * @return int
     *
     */
    public function del($where)
    {

        return AuthPermissions::query()->where($where)->update(['id_delete' => 1]);

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

        return AuthPermissions::query()->where($where)->update($param);
    }
}
