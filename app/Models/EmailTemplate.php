<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Enum\EmailTemplateEnum;

class EmailTemplate extends Model
{
    protected $table = 'email_template';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {

        return EmailTemplateEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
    {
        return EmailTemplateEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdateTimeAttribute($value)
    {

        return date('Y-m-d H:i:s', strtotime($value));
    }
}
