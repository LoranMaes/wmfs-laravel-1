<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $hidden = ['blogpost_id', 'author_id'];

    public function blogpost()
    {
        return $this->belongsTo(Blogpost::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
