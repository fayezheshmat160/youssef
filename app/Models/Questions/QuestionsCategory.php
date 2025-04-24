<?php

namespace App\Models\Questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsCategory extends Model
{
    use HasFactory;

    public $table = 'questions_categories';
    public $guarded = [];
}
