<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['url', 'title'];

    // Relazione many-to-many con Term
    public function terms()
    {
        return $this->belongsToMany(Term::class)
                    ->withPivot('occurrences')
                    ->withTimestamps();
    }
}
