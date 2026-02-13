<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Organization extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'city',
        'address',
        'website',
        'phone',
        'description',
        'reviews_count',
        'rating_avg',
    ];

    protected $casts = [
        'rating_avg' => 'float',
        'reviews_count' => 'int',
    ];

    protected static function booted(): void
    {
        static::saving(function (Organization $org) {
            if (blank($org->slug) && filled($org->name)) {
                $org->slug = Str::slug($org->name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('status', Review::STATUS_APPROVED);
    }

    public function recalcRating(): void
    {
        $q = $this->reviews()->where('status', Review::STATUS_APPROVED);

        $this->reviews_count = (int) $q->count();
        $this->rating_avg = (float) ($q->avg('rating') ?? 0);

        $this->save();
    }
}
