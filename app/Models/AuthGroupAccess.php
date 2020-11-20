<?php


namespace App\Models;


use App\Enum\AuthGroupAccessEnum;
use Illuminate\Database\Eloquent\Model;

class AuthGroupAccess extends Model
{
    protected $table = 'auth_group_access';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {
        return AuthGroupAccessEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return AuthGroupAccessEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}