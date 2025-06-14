<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gemba extends Model
{
    use HasFactory;

    protected $fillable =['location', 'date','team_lead','manager_id', 'status'];
    protected $casts = ['date'=> 'datetime'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function names()
    {
        return $this->hasMany(Name::class);
    }
    public function getmembers()
    {
        return $this->names();
    }
    public function actions()
    {
        return $this->hasMany(ActionList::class);

    }
    public function getactions()
    {
        return $this->actions();
    }
}
