<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Enum\ArticleEnum;
class ArticleSort extends Model
{
    protected $table = 'article_sort';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusAttribute($value)
    {

        return ArticleEnum::STATUS[$value];
    }


    public function getIsDeleteAttribute($value)
    {
        return ArticleEnum::DELETE[$value];
    }

    public function getCreateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdateTimeAttribute($value){

        return date('Y-m-d H:i:s',strtotime($value));
    }
}