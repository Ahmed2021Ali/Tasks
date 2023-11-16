<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_created',
        'task_done',
        'Rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
