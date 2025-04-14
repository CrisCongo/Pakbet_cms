<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Optionally, you can define fillable attributes to protect mass-assignment vulnerabilities
    protected $fillable = ['title', 'category', 'tags', 'cover_image', 'content', 'publish_date', 'status'];
}
