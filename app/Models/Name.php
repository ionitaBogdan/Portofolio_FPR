<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $fillable=['first_name', 'last_name', 'gemba_id'];
    public function gemba()
    {
        return $this->belongsTo(Gemba::class);
    }
    use HasFactory;
}
