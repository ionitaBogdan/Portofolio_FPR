<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string, string $string1, string $string2)
 */
class DashboardGemba extends Model
{
    use HasFactory;
    protected $table = 'gembas';
    protected $fillable = ['id', 'location', 'week', 'team_lead'];
}

