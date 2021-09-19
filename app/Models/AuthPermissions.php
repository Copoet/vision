<?php


namespace App\Models;


use App\Enum\AuthPermissionsEnum;
use Illuminate\Database\Eloquent\Model;

class AuthPermissions extends Model
{
    protected $table = 'auth_group_access';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {
        return AuthPermissionsEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return AuthPermissionsEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}
