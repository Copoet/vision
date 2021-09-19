<?php

namespace App\Models;

use App\Enum\CommonEnum;
use Illuminate\Database\Eloquent\Model;


class MerchantAdvertising extends Model
{

    protected $table = 'merchant_advertising';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {

        return CommonEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return CommonEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }
}
