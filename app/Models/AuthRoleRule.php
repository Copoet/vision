<?php

namespace App\Models;


use App\Enum\AuthRoleRuleEnum;
use Illuminate\Database\Eloquent\Model;

class AuthRoleRule extends Model
{
    protected $table = 'auth_role_rule';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {
        return AuthRoleRuleEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return AuthRoleRuleEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}