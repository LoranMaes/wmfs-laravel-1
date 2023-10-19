<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Author extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $appends = ['full_name'];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'website',
        'location',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    // protected function fullName(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value, $attributes) => ($attributes['first_name'] . ' ' . $attributes['last_name']),
    //     );
    // }

    public function blogposts()
    {
        return $this->hasMany(Blogpost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
