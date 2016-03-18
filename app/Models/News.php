<?php

namespace Attract\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
/**
 * An Eloquent Model: 'Post'
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $introtext
 * @property boolean $published
 * @property integer $col_comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $published_at
 * @property-read \Attract\Models\User $user
 */
class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'title', 'content', 'slug' , 'introtext'
    ];

    public static $rules = array(
      'title' => 'required|min:3',
      'content' => 'required|min:10',
    );

    //posts table in database
    protected $guarded = [];

    public function getPublishedNews()
    {
        $news = $this->latest()
          ->where('published',1)
          ->paginate(5);

        return $news;
    }

    public function getSlugNews($slug)
    {
        return $this->where('slug',$slug)->first();
    }

    public function user()
    {
        return $this->belongsTo('Attract\Models\User','user_id');
    }

    public function comments()
    {
        return $this->hasMany('Attract\Models\Comment','news_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $model->slug = str_slug($model->title);
            $model->published_at = Carbon::now();
            if (Auth::check()) {
                $model->user_id = Auth::user()->id;
            }
            return true;
        });
    }
}
