<?php

namespace Phpleaks;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '-',
                'includeTrashed' => true,
            ],
        ];
    }

    public function users()
    {
        return $this->belongsToMany('Phpleaks\User');
    }

    public function links()
    {
        return $this->belongsToMany(
            'Phpleaks\Link'
        )->withTimestamps();;
    }

    public function favorites()
    {
        return $this->belongsToMany(
            'Phpleaks\User', 'link_tag', 'link_id', 'user_id'
        );
    }
}
