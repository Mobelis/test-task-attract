<?php

namespace Attract\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'text','user_id','news_id'
    ];

    public static $rules = array(
      'text' => 'required|min:10',
    );

    //comments table in database
    protected $guarded = [];

    // user who commented
    public function user()
    {
        return $this->belongsTo('Attract\Models\User','user_id');
    }

    public function news()
    {
        return $this->belongsTo('Attract\Models\News','news_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            if (Auth::check()) {
                $model->user_id = Auth::user()->id;
            }
            return true;
        });

        static::saved(function($model) {
            News::find($model->news_id)->increment('col_comment');
            return true;
        });
        
        static::deleted(function($model) {
            News::find($model->news_id)->decrement('col_comment');
            return true;
        });
    }
}
