<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string, string $string1, string $string2)
 */
class DashboardName extends Model
{
    use HasFactory;
    protected $table ='names';
    protected $fillable = [ 'id', 'first_name','last_name'];
}
