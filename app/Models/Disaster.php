<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    protected $fillable = [
        'location',
        'description',
        'severity',
        'time',
        'date',
        'created_by',
    ];

    /**
     * Get the user that created the disaster.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
