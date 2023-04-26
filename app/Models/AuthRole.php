<?php


namespace App\Models;


use App\Enum\AuthRoleEnum;
use Illuminate\Database\Eloquent\Model;

class AuthRole extends Model {

    protected $table = 'auth_role';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $fillable = ['name'];

    public function getStatusAttribute($value)
    {
        return AuthRoleEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return AuthRoleEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}
