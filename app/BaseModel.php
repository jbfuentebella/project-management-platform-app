<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
}
