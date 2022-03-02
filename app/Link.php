<?php namespace Phpleaks;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Link extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '-',
                'includeTrashed' => true,
            ],
        ];
    }

    protected $fillable = ['name', 'url', 'description'];

    private $rules = [
        'name' => 'required',
        'url' => 'required|url|unique:links,url',
        'category' => 'required|integer|min:1',
        'description' => 'required|max:500',
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

    public function category()
    {
        return $this->belongsTo('Phpleaks\Category');
    }

    public function user()
    {
        return $this->belongsTo('Phpleaks\User');
    }

    public function tags()
    {
        return $this->belongsToMany('Phpleaks\Tag')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany('Phpleaks\User')->withTimestamps();
    }

    public function currentTags()
    {
        return $this->tags();
    }

    public function favorites()
    {
        return $this->belongsToMany(
            'Phpleaks\User', 'link_user', 'link_id', 'user_id'
        );
    }
}
