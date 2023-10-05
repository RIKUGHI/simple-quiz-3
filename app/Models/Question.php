<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    function questionDetails(): HasMany {
        return $this->hasMany(QuestionDetail::class);
    }

    function answers(): HasManyThrough {
        return $this->hasManyThrough(Answer::class, QuestionDetail::class);
    }

    function done(): HasOne {
        return $this->hasOne(QuestionDone::class);
    }
}
