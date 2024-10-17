<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Define the table associated with the model
    protected $table = 'events';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'category',
    ];

    // Define any relationships (if applicable)
    // For example, if you have a User model that can be related to events, you could add:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Define accessors or mutators if needed
}
