<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishingHouseUser extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'publishing_house_id', 'position'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function publishingHouse() {
        return $this->belongsTo(PublishingHouse::class);
    }

    public function reviewedRequests() {
        return $this->hasMany(PublishingRequest::class, 'reviewer_id');
    }
}
