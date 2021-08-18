<?php


namespace App\Models;


use App\Enum\AuthManagerRoleEnum;
use Illuminate\Database\Eloquent\Model;

class AuthManagerRole extends Model
{
    protected $table = 'auth_manager_group';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {
        return AuthManagerRoleEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return AuthManagerRoleEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}
