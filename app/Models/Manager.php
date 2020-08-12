<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //

    protected $table = 'manage';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';


}
