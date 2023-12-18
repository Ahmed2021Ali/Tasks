<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Client extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function getAllClients()
    {
         return Client::all();
    }
    public function getClient($id)
    {
        return Client::where('id' , $id)->first();
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

}
