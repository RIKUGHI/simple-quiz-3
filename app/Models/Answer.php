<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    function questionDetail(): HasOne {
        return $this->hasOne(QuestionDetail::class);
    }
}
