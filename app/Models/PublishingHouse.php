<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishingHouse extends Model
{
    /** @use HasFactory<\Database\Factories\PublishingHouseFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'website_url', 'email'];

    public function users() {
        return $this->belongsToMany(User::class)
                    ->using(PublishingHouseUser::class)
                    ->withPivot('position')
                    ->withTimestamps();
    }

    public function publishingHouseUsers() {
        return $this->hasMany(PublishingHouseUser::class);
    }

    public function publishingRequests() {
        return $this->hasMany(PublishingRequest::class);
    }
}
