<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\SystemEnum;

class SlideShow extends Model
{
    //

    protected $table = 'slideshow';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {

        return SystemEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return SystemEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }
}
