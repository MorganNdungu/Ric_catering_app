<?php

namespace App\Models;

use App\Models\BirthdayPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class BirthdayPackageImage extends Model
{
    protected $fillable = [
        'image_path',
    ];

    // Define a relationship with the package
    public function package(): BelongsTo
    {
        return $this->belongsTo(BirthdayPackage::class);
    }
}
