<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\updateTaskRequest;
use App\Http\traits\media;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\LogMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use media;

    public $client;
    public $user;
    public $task;

    public function __construct()
    {
        $this->client = new Client();
        $this->user = new User();
        $this->task = new Task();

        $this->middleware('permission:task.store', ['only' => ['store']]);
        $this->middleware('permission:task.update', ['only' => ['update']]);
        $this->middleware('permission:task.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        $clients = $this->client->getAllClients();
        $users = $this->user->getAllUsers();
        $main_tasks = Task::where('type', 'main')->paginate(15);
        return view('task.main.index', compact('main_tasks', 'clients', 'users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $uuid = Str::random(16);
        $task = Task::create([
            ...$request->validated(),
            'assigned_by' => auth()->user()->id,
            'type' => 'main',
            'main_id' => $uuid,
        ]);
        $this->activities($task->main_id);
        if ($request->notify) {
            $this->notify_all_operation_store_task($task);
        } else {
            $this->notify_without_client_operation_store_task($task);
        }
        return redirect()->back()->with(['success' => 'Add Task successfully']);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $log_message = LogMessage::where('task_id', $task->id)->first();
        $task->update([
            ...$request->validated(),
            'assigned_by' => auth()->user()->id,
        ]);
        $this->activities($task->main_id);
        if ($request->notify) {
            if ($log_message) {
                if ($log_message->status == "Failed") {
                    $this->notify_all_operation_update_task($task);
                } else {
                    $this->notify_client_only_operation_update_task($task);
                }
            } else {
                $this->notify_all_operation_store_task($task);
            }
        } else {
            if ($log_message) {
                if ($log_message->status == "Failed") {
                    $this->notify_without_client_operation_update_task($task);
                }
            } else {
                $this->notify_without_client_operation_store_task($task);
            }
        }
        return redirect()->back()->with(['success' => 'Update Task successfully']);
    }

    public function delete(Task $task)
    {
        if ($task->type == "main") {
            $tasks = Task::where('main_id', $task->main_id)->get();
            foreach ($tasks as $tas) {
                $tas->delete();
                $this->activities($tas->main_id);
            }
            return redirect()->route('task.index')->with(['success' => 'Delete Successfully']);
        } else {
            $task->delete();
            $this->activities($task->main_id);
            return redirect()->back()->with(['success' => 'Delete Successfully']);
        }
    }


}
