<?php


namespace App\Models;


use App\Enum\AuthRuleEnum;
use Illuminate\Database\Eloquent\Model;

class AuthRule extends Model {

    protected $table = 'auth_rule';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {
        return AuthRuleEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return AuthRuleEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}