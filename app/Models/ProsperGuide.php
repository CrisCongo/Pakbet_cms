<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProsperGuide extends Model
{
    protected $table = 'prosper_guides';
    protected $primaryKey = 'zodiacID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'zodiacID', 'overview', 'career', 'health', 'love', 'wealth', 'publish_date', 'status'
    ];
}

