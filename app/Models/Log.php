<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'search_logs';
    protected $fillable = [
        'session_id', 
        'page_id',
        'user_id',
    ];

    // Relazione con la pagina
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}