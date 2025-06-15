<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionList extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_raised',
        'improvements',
        'location',
        'status',
        'date_complete',
        'comment',
        'comment_img',
        'activity_transport',
        'activity_inv',
        'activity_motion',
        'activity_waiting',
        'activity_overprocess',
        'activity_overproduct',
        'activity_defect',
        'activity_skills',
        'gemba_id',
        'due_date',
        'title',
        'manager_id'  // Include manager_id here
    ];

    public function gemba()
    {
        return $this->belongsTo(Gemba::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
