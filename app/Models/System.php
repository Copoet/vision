<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    //

    protected $table = 'system';


    protected $primaryKey = 'id';


    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';
}
