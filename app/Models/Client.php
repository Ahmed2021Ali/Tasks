<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function get_clients()
    {
         return Client::all();
    }
    public function task()
    {
        return $this->hasMany(Task::class);
    }
/*     public function parent()
    {
        return $this->hasMany(ParentTask_id::class);
    }
    public function messageLog()
    {
        return $this->hasMany(messageLog::class);
    } */
}
