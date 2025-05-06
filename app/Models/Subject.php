<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name','type'];

    protected $casts = [
        'type' => 'string'
    ];

    public function passages()
    {
        return $this->hasMany(Passage::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
