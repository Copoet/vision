<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Enum\ArticleEnum;

class Article extends Model
{
    protected $table = 'article';


    protected $primaryKey = 'id';

    protected $fillable = ['title','titlepic','content','flag','keywords','description','views'];

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


    public function getStatusStrAttribute($value)
    {

        return ArticleEnum::STATUS[$value];
    }


    public function getIsDeleteStrAttribute($value)
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
