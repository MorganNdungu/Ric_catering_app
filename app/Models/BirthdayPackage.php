<?php

namespace App\Models;

use App\Models\BirthdayPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BirthdayPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price', 'image_path', 'gallery', 'deleted_at',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(BirthdayPackageImage::class);
    }
}
