<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Http\traits\media;
use App\Models\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;

class SubTaskController extends Controller
{
    use media;

    public $client;
    public $user;
    public $main_task_id;

    public function __construct()
    {
        $this->client=new Client();
        $this->user=new User();
        $this->main_task_id=new Task();
    }

    public function index($main_id)
    {
        $users=$this->user->getAllUsers();
        $clients=$this->client->getAllClients();
        $main_task =$this->main_task_id->get_main_task($main_id);
        $sub_tasks = Task::where('main_id',$main_id)->get();
        $log_messages=LogMessage::where('main_id',$main_id)->get();
        $logs= Activity::where('log_name' ,$main_id)->get();
        return view('task.sub.index',compact('main_task','sub_tasks','users','clients','log_messages','logs'));
    }

    public function store(Request $request,$main_id)
    {
        $main_task =$this->main_task_id->get_main_task($main_id);
        $current_time = now();
        if($request->dateline > $current_time->format('Y-m-d H:i:s'))
        {
            $task= Task::create([
                ...$request->except(['_token','notify']),
                 'assigned_by'=>auth()->user()->id,
                 'type'=>'sub',
                 'main_id'=> $main_id,
                 'client_id'=>$main_task->client_id,
                ]);
                $this->activities($task->main_id);
                if($request->notify) {
                    $this->notify_all_operation_store_task($task);
                }
                else {
                    $this->notify_without_client_operation_store_task($task);
                }
             return redirect()->back()->with(['success'=>'Add SubTask successfully']);
        } else {
             return redirect()->back()->with(['error'=>'date not invalid']);
        }
    }

    public function extend_option(Request $request,Task $task)
    {
        $current_time = now();
        if($request->extend_request == $task->dateline ) {
            return redirect()->back()->with(['error'=>'Request DateLine Not Valid']);
        } else{
            Task::create([
                'title'=>'Extend Dateline',
                'description'=>$request->description,
                'request_at'=>$current_time->format('Y-m-d H:i:s'),
                'dateline'=>$task->dateline,
                'assigned_to'=>$task->assigned_by,
                'assigned_by'=>$task->assigned_to,
                'extend_request'=>$request->extend_request,
                'client_id'=>$task->client_id,
                'type'=>"option",
                'main_id'=>$task->main_id,
                'extended'=>$task->id
                ]);
            $this->activities($task->main_id);
        }
        return redirect()->back()->with(['success'=>'Save Date successfully']);
    }

    public function extend_status(Request $request,$id)
    {
        $task = Task::where('id',$id)->first();
        $task_old=Task::where('id',$task->extended)->first();
        if($request->value == "prove") {
          $task_notify = Task::create([
                'title'=>$task_old->title,
                'client_id'=>$task_old->client_id,
                'description'=>$task_old->description,
                'request_at'=>$task_old->request_at,
                'dateline'=>$task->extend_request,
                'assigned_to'=>$task_old->assigned_to,
                'assigned_by'=>$task_old->assigned_by,
                'main_id'=>$task_old->main_id,
                'type'=>$task_old->type,
                ]);
                $this->activities($task->main_id);
                $task->update(['status'=>'1','type'=>'prove']);
                $task_old->update(['status'=>'1','type'=>'extended']);
            $this->notify_without_client_operation_store_task($task_notify);

        } elseif($request->value == "reject") {
            Task::where('id',$task->id)->update(['status'=>'1','type'=>'reject']);
        } else {
            return redirect()->back()->with(['error'=>'error 404']);
        }
        return redirect()->back()->with(['success'=>'Save Date successfully']);
    }

    public function upload_file(Request $request,Task $task)
    {
        $current_time=now();
        if($task) {
            $file = $request->file->store('Files_Task', 'public');
            $task->update([
                'file'=>$file,
                'delivery_time'=>$current_time->format('Y-m-d H:i:s'),
            ]);
            $this->activities($task->main_id);
            $this->delay_upload_file($task);
        }
        return redirect()->back()->with(['success'=>'Save File successfully']);
    }

    public function download_file(Request $request,Task $task)
    {
        $file = storage_path('app/public/' . $task->file);
        return response()->file($file);
    }

    public function status(Task $task)
    {
        if($task->type == "main") {
            $sub_tasks = Task::select('status')->where('status','0')->where('type','sub')->where('main_id',$task->main_id)->get();
            if(!$sub_tasks->isEmpty()) {
                return redirect()->back()->with(['error'=>'Not Change, please check Status Subtask']);
            } else {
                $task->update(['status'=>1]);
                $this->activities($task->main_id);

            }
        }
        elseif($task->type == "sub") {
            $task->update(['status'=>1]);
            $this->activities($task->main_id);

        } else {
            return false;
        }
        return redirect()->back()->with(['success'=>'Change Status successfully']);
    }

}
