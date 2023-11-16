<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LogMessage extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['task_id',
                'message',
                'client_id',
                'assigned_to',
                'assigned_by',
                'status',
                'main_id',]);
    }

    protected $fillable = [
        'task_id',
        'message',
        'client_id',
        'assigned_to',
        'assigned_by',
        'status',
        'main_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assigned_by_user()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
