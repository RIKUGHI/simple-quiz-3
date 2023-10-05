<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuestionDetail extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    function question(): HasOne {
        return $this->hasOne(Question::class);
    }

    function answer(): HasOne {
        return $this->hasOne(Answer::class);
    }
}
