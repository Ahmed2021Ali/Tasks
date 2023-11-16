<?php

namespace App\Http\Controllers;

use App\Http\traits\media;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\LogMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;

class TaskController extends Controller
{
    use media;
    public $client;
    public $user;
    public $task;

    public function __construct()
    {
        $this->client=new Client();
        $this->user=new User();
        $this->task=new Task();
    }

    public function index()
    {
        $clients=$this->client->get_clients();
        $users=$this->user->get_users();
        $main_tasks=Task::where('type','main')->paginate(15);
        return view('task.main.index', compact('main_tasks','clients','users'));
    }

    public function store(Request $request)
    {
        $current_time = now();
        if($request->dateline > $current_time->format('Y-m-d H:i:s'))
        {
            $uuid = Str::random(16);
            $task= Task::create([
                ...$request->except(['_token','notify']),
                 'assigned_by'=>auth()->user()->id,
                 'type'=>'main',
                 'main_id'=> $uuid,
                ]);
            $this->activities($task->main_id);
            if($request->notify)
            {
                $this->notify_all_operation_store_task($task);
            }
            else
            {
                $this->notify_without_client_operation_store_task($task);
            }
             return redirect()->back()->with(['success'=>'Add Task successfully']);
        }
        else
        {
             return redirect()->back()->with(['error'=>'date not invalid']);
        }
    }

    public function update(Request $request ,$id)
    {
        $task =$this->task->get_task($id);
        $log_message= LogMessage::where('task_id',$task->id)->first();
        $current_time = now();
        if($request->dateline > $current_time->format('Y-m-d H:i:s'))
        {
            $task->update([
                ...$request->except(['_token','notify','_method']),
                 'assigned_by'=>auth()->user()->id,
                ]);
            $this->activities($task->main_id);
            if($request->notify)
            {
                if($log_message)
                {
                    if($log_message->status == "Failed")
                    {
                        $this->notify_all_operation_update_task($task);
                    }
                    else
                    {
                        $this->notify_client_only_operation_update_task($task);
                    }
                }
                else
                {
                    $this->notify_all_operation_store_task($task);
                }

            }
            else
            {
                if($log_message)
                {
                    if($log_message->status == "Failed")
                    {
                        $this->notify_without_client_operation_update_task($task);
                    }
                }
                else
                {
                    $this->notify_without_client_operation_store_task($task);
                }
            }
             return redirect()->back()->with(['success'=>'Update Task successfully']);
        }
        else
        {
             return redirect()->back()->with(['error'=>'date not invalid']);
        }
    }

    public function delete($id)
    {
        $task=Task::where('id',$id)->first();
        if($task->type =="main")
        {
            $tasks=Task::where('main_id',$task->main_id)->get();
            foreach($tasks as $task) {
                $task->delete();
                $this->activities($task->main_id);
            }
            return redirect()->route('task.index')->with(['success'=>'Delete Successfully']);
        }
        else
        {
            $task->delete();
            $this->activities($task->main_id);
            return redirect()->back()->with(['success'=>'Delete Successfully']);
        }
    }





}
