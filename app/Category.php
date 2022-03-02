<?php namespace Phpleaks;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
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

    private $rules = [
        'name' => 'required',
    ];

    public function validate()
    {

        $v = \Validator::make($this->attributes, $this->rules);
        if ($v->passes()) {
            return true;
        }
        $this->errors = $v->messages();

        return false;

    }

    /**
     * Each category can be associated with one or more news items.
     *
     */
    public function links()
    {
        return $this->hasMany('Phpleaks\Link');
    }

}
