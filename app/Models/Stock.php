<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enum\StockEnum;
class Stock extends Model
{
    //

    protected $table = 'stock';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';



    public function getStatusStrAttribute($value)
    {

        return StockEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return StockEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }


}
