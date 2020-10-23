<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Enum\EmailLogEnum;

class EmailLog extends Model
{
    protected $table = 'email_log';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {

        return EmailLogEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return EmailLogEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }
}