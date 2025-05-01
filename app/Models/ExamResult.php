<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'verbal_score',
        'quantitative_score',
        'total_score',
        'correct_count',
    ];

    // Optional: Relation to student (user)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
