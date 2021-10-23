<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blog_posts';
    protected $guarded = [];

    public function comments(){
        return $this->hasMany(Comment::class, 'blog_post_id', 'id')->latest();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id' ,'id');
    }

    public function scopeLatest(Builder $query) {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query){
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public static function boot(){
        parent::boot();

        // GLOBAL QUERY SCOPE
        // static::addGlobalScope(new LatestScope);

        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
        });

        /* static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        }); */
    }

}
