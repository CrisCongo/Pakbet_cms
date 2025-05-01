<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $primaryKey = 'blogID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'title',
        'category',
        'tags',
        'publish_date',
        'status',
        'cover_image',
        'content',
    ];
}
