<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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
        return is_null($this->published_at) ? '' : $this->published_at->formatLocalized("%B %d" . ", %Y");
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHtmL(e($this->body)) : NULL;
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeSheduled($query)
    {
        return $query->where('published_at', '>', Carbon::now());
    }

    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function getDateForPopularAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->formatLocalized("%B %d" . ", %Y");
    }

    public function getTagsHtmlAttribute($value)
    {
        $anchors = [];

        foreach ($this->tags as $tag) {
            $anchors[] = '<a href="' . route('tag', $tag->slug) . '">' . $tag->title . '</a>';
        }
        return implode(", ", $anchors);
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

    public function scopeSearch($query, $search)
    {
        if (isset($search['month']) && $month = $search['month']) {
            if (env("DB_CONNECTION") === 'pgsql') {
                $query->whereRaw('extract(month from published_at) = ?', [$month]);
            } else {
                $query->whereRaw('month(published_at) = ?', [$month]);
            }
        }

        if (isset($search['year']) && $year = $search['year']) {
            if (env("DB_CONNECTION") === 'pgsql') {
                $query->whereRaw('extract(year from published_at) = ?', [$year]);
            } else {
                $query->whereRaw('year(published_at) = ?', [$year]);
            }
        }

        if (isset($search['query']) && $filter = strtolower($search['query'])) {
            $query->where(function ($q) use ($filter) {
                $q->whereHas('author', function ($qr) use ($filter) {
                    $qr->where('name', 'LIKE', "%{$filter}%");
                });
                $q->orWhereHas('category', function ($qr) use ($filter) {
                    $qr->where('title', 'LIKE', "%{$filter}%");
                });
                $q->where('title', 'LIKE ?', ["%{$filter}%"]);
                $q->orWhere('excerpt', 'LIKE ?', ["%{$filter}%"]);
            });
        }
    }

    public static function archives()
    {
        if (env("DB_CONNECTION") === 'pgsql') {
            return static::selectRaw('count(id) as total_count, extract(year from published_at) as year, extract(month from published_at) as month')
                ->published()
                ->groupBy('year', 'month')
                ->orderByRaw('min(published_at) desc')
                ->get();
        } else {
            return static::selectRaw('count(id) as total_count, year(published_at) year, month(published_at) month')
                ->published()
                ->groupBy('year', 'month')
                ->orderByRaw('min(published_at) desc')
                ->get();
        }
    }

    public function getTagsListAttribute()
    {
        return $this->tags->pluck('name');
    }

    public function createTags($tagString)
    {

        $tags = explode(',', $tagString);
        $tagIds = [];

        foreach ($tags as $tag) {

            $newTag = Tag::firstOrCreate(
                ['title' => ucwords(trim($tag))],
                ['slug' => str_slug($tag)]
            );
            /*$newTag->title = ucwords(trim($tag));
            $newTag->slug = str_slug($tag);
            $newTag->save();
            */
            //$newTag->save();
            $tagIds[] = $newTag->id;
        }

        $this->tags()->detach();
        $this->tags()->attach($tagIds);
    }
}