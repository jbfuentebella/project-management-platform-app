<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Developer extends Model
{
    const TYPE_FRONTEND = 'frontend';
    const TYPE_BACKEND = 'backend';

    protected $fillable = ['name', 'type', 'slug'];

    protected $attributes = [
        'slug' => self::self::generateUniqueSlug(8),
    ];

    public static function generateUniqueSlug($tokenLength) 
    {
        do {
            $newToken = Str::random($tokenLength);
        } while (!empty(Developer::where('slug', $newToken)->first()));

        return $newToken;
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
