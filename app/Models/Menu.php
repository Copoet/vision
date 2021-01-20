<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enum\MenuEnum;
class Menu extends Model
{
    //


    protected $table = 'menu';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {

        return MenuEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return MenuEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }



}
