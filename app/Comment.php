<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;


class Comment extends Model
{
    protected $fillable = [
        'author_name', 'author_email', 'body', 'post_id'
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }

    public function getDateAttribute($value)
    {
        return is_null($this->created_at) ? '' : $this->created_at->formatLocalized("%B %d" . ", %Y");
    }
}