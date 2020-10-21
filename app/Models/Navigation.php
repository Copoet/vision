<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enum\NavigationEnum;

class Navigation extends Model
{
    //

    protected $table = 'navigation';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {

        return NavigationEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return NavigationEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

}
