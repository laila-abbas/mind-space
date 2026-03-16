<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishingHouse extends Model
{
    /** @use HasFactory<\Database\Factories\PublishingHouseFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'website_url', 'email', 'logo'];

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

    public function editions() {
        return $this->hasMany(Edition::class);
    }

    // subquery to add a count column w/o loading all book into memory
    public function scopeWithPublishedBooksCount($query) {
        return $query->addSelect([ 
            'published_books_count' => Edition::selectRaw('COUNT(DISTINCT book_id)') 
                ->whereColumn('publishing_house_id', 'publishing_houses.id')
                ->whereNotNull('published_at')
        ]);
    }

    public function getLogoUrlAttribute() {
        return asset('storage/' . $this->logo);
    }
}
