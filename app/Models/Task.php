<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title',
                'description',
                'request_at',
                'dateline',
                'extend_request',
                'client_id',
                'assigned_to',
                'assigned_by',
                'status',
                'type',
                'file',
                'extended',
                'delivery_time',
                'delay_upload_file',
                'id']);
    }

    protected $fillable = [
        'title',
        'description',
        'request_at',
        'dateline',
        'extend_request',
        'client_id',
        'assigned_to',
        'assigned_by',
        'status',
        'notify',
        'file',
        'type',
        'main_id',
        'extended',
        'delivery_time',
        'delay_upload_file'
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    public function get_main_task($main_id)
    {
        return Task::where('type', 'main')->where('main_id', $main_id)->first();
    }

    public function get_task($id)
    {
        return Task::where('id', $id)->first();
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assigned_by_user()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function messageLog()
    {
        return $this->hasOne(LogMessage::class);
    }
}
