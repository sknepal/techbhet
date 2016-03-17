<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['title', 'category_id', 'description', 'date', 'time', 'main_image', 'location', 'owner_id',
                            'meetup', 'fb', 'organizer', 'details_organizer', 'tags'];

    protected $hidden = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
