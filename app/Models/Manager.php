<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enum\ManagerEnum;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Manager extends Authenticatable implements JWTSubject
{
    //

    protected $table = 'manager';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    public function getStatusAttribute($value)
    {

        return ManagerEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return ManagerEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return[];
    }
}
