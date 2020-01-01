<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImgUrlAttribute($value)
    {

        $img_url = "";

        if (!is_null($this->img)) {

            $img_path = public_path() . "/img/" . $this->img;

            if (file_exists($img_path)) {
                $img_url = asset('img/' . $this->img);
            }
        }
        return $img_url;
    }

    public function getImgThumbUrlAttribute($value)
    {

        $img_url = "";

        if (!is_null($this->img)) {

            $ext = substr(strchr($this->img, "."), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->img);
            $img_path = public_path() . "/img/" . $thumbnail;

            if (file_exists($img_path)) {
                $img_url = asset('img/' . $thumbnail);
            }
        }
        return $img_url;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->formatLocalized("%B %d" . ", %Y" . " at " . date('H:i'));
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHtmL(e($this->body)) : NULL;
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function getDateForPopularAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->formatLocalized("%B %d" . ", %Y" . " at " . date('H:i'));
    }
}