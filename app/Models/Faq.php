<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $primaryKey = 'faqID';

    protected $fillable = [
        'question',
        'answer',
        'publish_date',
        'status',
    ];
}
