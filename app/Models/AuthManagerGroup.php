<?php


namespace App\Models;


use App\Enum\AuthManagerGroupEnum;
use Illuminate\Database\Eloquent\Model;

class AuthManagerGroup extends Model
{
    protected $table = 'auth_manager_group';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {
        return AuthManagerGroupEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return AuthManagerGroupEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}