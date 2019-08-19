<?php

namespace App;

use Illuminate\Support\Str;

use App\BaseModel;

class Project extends BaseModel
{
    protected $fillable = [
        'name', 'client_name', 'lead_developer_id', 'slug'
    ];

    protected $hidden = ['id'];

    public static function generateUniqueSlug($tokenLength) 
    {
        do {
            $newToken = Str::random($tokenLength);
        } while (!empty(Project::where('slug', $newToken)->first()));

        return $newToken;
    }

    public function leadDeveloper()
    {
        return $this->belongsTo('App\Developer', 'lead_developer_id', 'slug');
    }
}
