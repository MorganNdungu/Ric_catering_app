<?php

namespace App\Models;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cake extends Model
{
    use HasFactory;
    protected $table = 'cakes'; 

    protected $fillable = [
        'name', 'description', 'price', 'image_path'];
}
