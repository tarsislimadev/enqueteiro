<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'title', 'answers', 'hash', 'owner',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'form_id', 'id');
    }
}
