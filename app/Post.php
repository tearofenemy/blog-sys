<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id', 'img'];
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

            $dir = config('cms.img.directory');
            $img_path = public_path() . "/{$dir}/" . $this->img;

            if (file_exists($img_path)) {
                $img_url = asset("{$dir}/" . $this->img);
            }
        }
        return $img_url;
    }

    public function getImgThumbUrlAttribute($value)
    {

        $img_url = "";
        $dir = config('cms.img.directory');
        if (!is_null($this->img)) {

            $ext = substr(strchr($this->img, "."), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->img);
            $img_path = public_path() . "/{$dir}/" . $thumbnail;

            if (file_exists($img_path)) {
                $img_url = asset("{$dir}/" . $thumbnail);
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

    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if ($showTimes) $format = $format . " H:i";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (!$this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        } else if ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="label label-info">Shedule</span>';
        } else {
            return '<span class="label label-success">Published</span>';
        }
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: NULL;
    }
}