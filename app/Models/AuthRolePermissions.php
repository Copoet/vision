<?php

namespace App\Models;


use App\Enum\AuthRolePermissionsEnum;
use Illuminate\Database\Eloquent\Model;

class AuthRolePermissions extends Model
{
    protected $table = 'auth_role_rule';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {
        return AuthRolePermissionsEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return AuthRolePermissionsEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}
