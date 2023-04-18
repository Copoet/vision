<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enum\SystemEnum;
class System extends Model
{
    //

    protected $table = 'system';


    protected $primaryKey = 'id';

    protected $fillable = ['sys_name','sys_value','sys_explain','sys_type','status'];

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
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
