<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['term'];

    public function pages()
    {
        return $this->belongsToMany(Page::class)
                    ->withPivot('occurrences')
                    ->withTimestamps();
    }
}
