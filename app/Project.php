<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'name', 'client_name', 'lead_developer_id', 'slug'
    ];

    protected $attributes = [
        'slug' => self::self::generateUniqueSlug(8),
    ];

    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    public static function generateUniqueSlug($tokenLength) 
    {
        do {
            $newToken = Str::random($tokenLength);
        } while (!empty(Project::where('slug', $newToken)->first()));

        return $newToken;
    }

    public function leadDeveloper()
    {
        return $this->belongsTo('App\Developer');
    }
}
