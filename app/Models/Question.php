<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['subject_id', 'type', 'question','photo', 'options', 'correct_answer','explane_answer','notes'];

    protected $casts = [
        'options' => 'array',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
