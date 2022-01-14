<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'date',
        'content',
        'image',
        'event_category_id',
    ];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id', 'id');
    }
}
