<?php

namespace App\Http\traits;

use App\Models\Report;
use App\Models\Task;
use App\Models\LogMessage;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;

trait media
{

    public function  dispatchAll($task)
    {
        $message=$task->title;
        // send message to client
        $phone_client=$task->client->phone;
        // send message to assigned_to_user
        $phone_assigned_to_user=$task->assigned_to_user->phone;
        // send message to assigned_by_user
        $phone_assigned_by_user=$task->assigned_by_user->phone;
        // dd($phone_client,$message_client,$phone_assigned_to_user,$message_assigned_to_user,$phone_assigned_by_user,$message_assigned_by_user);
        dispatch(function() use ($phone_client,$phone_assigned_to_user,$phone_assigned_by_user,$message){
            Artisan::call('app:notify-client', ['phone' => $phone_client, 'message' => $message]);
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_to_user, 'message' => $message]);
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_by_user, 'message' => $message]);
        });
    }

    public function dispatchWithoutClient($task) {
        $message=$task->title;
        //send message to assigned_to_user
        $phone_assigned_to_user=$task->assigned_to_user->phone;
        //send message to assigned_by_user
        $phone_assigned_by_user=$task->assigned_by_user->phone;

        dispatch(function() use ($phone_assigned_to_user,$phone_assigned_by_user,$message){
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_to_user, 'message' => $message]);
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_by_user, 'message' => $message]);
        });
    }

    // operation store task , Notify all user (Assigned To and Assigned By) and client
    public function notify_all_operation_store_task($task)
    {
        try {
           $this->dispatchAll($task);
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$task->title,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Done',
                'main_id'=>$task->main_id,
            ]);
            $this->activities($task->main_id);
        }
         catch (\Exception $e) {
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$task->title,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Failed',
                'main_id'=>$task->main_id,
            ]);
            $this->activities($task->main_id);
        }
    }

    // operation store task , Notify all user (Assigned To and Assigned By)
    public function notify_without_client_operation_store_task($task)
    {
        try {
            $this->dispatchWithoutClient($task);
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$task->title,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Done',
                'main_id'=>$task->main_id,
            ]);
            $this->activities($task->main_id);
        } catch (\Exception $e) {
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$task->title,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Failed',
                'main_id'=>$task->main_id,
            ]);
            $this->activities($task->main_id);

        }
    }

    // operation update task , Notify all user (Assigned To and Assigned By)
     public function notify_without_client_operation_update_task($task)
    {
        $logMessage=LogMessage::where('task_id', $task->id)->first();
            try {
                $this->dispatchWithoutClient($task);
                $logMessage->update([
                    'task_id'=>$task->id,
                    'message'=>$task->title,
                    'assigned_to'=>$task->assigned_to,
                    'assigned_by'=>$task->assigned_by,
                    'status'=>'Done'
                ]);
                $this->activities($task->main_id);
            } catch (\Exception $e) {
                $logMessage->update([
                    'task_id'=>$task->id,
                    'message'=>$task->title,
                    'assigned_to'=>$task->assigned_to,
                    'assigned_by'=>$task->assigned_by,
                    'status'=>'Failed'
                ]);
                $this->activities($task->main_id);
            }
    }

    // operation update task , Notify all user (Assigned To and Assigned By) and client
    public function notify_all_operation_update_task($task)
    {
        $logMessage=LogMessage::where('task_id', $task->id)->first();
        try {
            $this->dispatchAll($task);
            $logMessage->update([
                'task_id'=>$task->id,
                'message'=>$task->title,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Done'
            ]);
            $this->activities($task->main_id);
        }
         catch (\Exception $e) {
            $logMessage->update([
                'task_id'=>$task->id,
                'message'=>$task->title,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Failed'
            ]);
            $this->activities($task->main_id);
        }
    }
    // operation update task , Notify  client Only
    public function notify_client_only_operation_update_task($task)
    {
        $logMessage=LogMessage::where('task_id', $task->id)->first();
        try
        {
            $message=$task->title;
            // send message to client
            $phone_client=$task->client->phone;
            // dd($phone_client,$message_client,$phone_assigned_to_user,$message_assigned_to_user,$phone_assigned_by_user,$message_assigned_by_user);
             dispatch(function() use ($phone_client,$message){
                Artisan::call('app:notify-client', ['phone' => $phone_client, 'message' => $message]);
            });
            $logMessage->update([
                    'task_id'=>$task->id,
                    'message'=>$message,
                    'client_id'=>$task->client_id,
                    'status'=>'Done'
                ]);
            $this->activities($task->main_id);
        }
             catch (\Exception $e)
            {
                $logMessage->update([
                    'task_id'=>$task->id,
                    'message'=>$message,
                    'client_id'=>$task->client_id,
                    'status'=>'Failed'
                ]);
            }
        $this->activities($task->main_id);
    }
    // operation filed Notify , Notify  All User and Client
    public function notify_all_again($log_message)
    {
        $task = Task::where('task_id', $log_message->task_id)->first();
        try
        {
            $this->dispatchAll($task);
            $log_message->update([
                'status'=>'Done'
            ]);
            $this->activities($log_message->task->main_id);
        } catch (\Exception $e) {
             $log_message->update([
                'status'=>'Failed'
            ]);
             $this->activities($log_message->task->main_id);
         }
    }
        // operation filed Notify , Notify all user (Assigned To and Assigned By)
    public function notify_without_client_again($log_message)
    {
        $task = Task::where('task_id', $log_message->task_id)->first();
        try {
            $this->dispatchWithoutClient($task);
            $log_message->update([
                'status'=>'Done'
            ]);
            $this->activities($log_message->task->main_id);
        } catch (\Exception $e) {
             $log_message->update([
                'status'=>'Failed'
            ]);
             $this->activities($log_message->task->main_id);
         }
    }

    public function report($id)
    {
        $done_tasks=Task::where('status', '1')->where('assigned_to','=',$id)->where('type', 'main')->OrWhere('type', 'sub')->count();
        $total_tasks=Task::where('assigned_to',$id)->where('type', 'main')->OrWhere('type', 'sub')->count();

        if( $done_tasks > 0 && $total_tasks > 0)
        {
           $Rate = ($done_tasks / $total_tasks) * 100 ;
        }
        Report::where('user_id',$id)->update([
            'task_created'=>$total_tasks?? '0',
            'task_done'=>$done_tasks?? '0',
            'Rate'=> $Rate?? '0',
        ]);
    }

    public function delay_upload_file($task)
    {
       if($task->dateline > $task->delivery_time)
       {
             $task->update(['delay_upload_file'=>'Yes']);
       }
       else
       {
           $task->update(['delay_upload_file'=>'No']);
       }
    }

    public function activities($main_id)
    {
        $activity= Activity::all()->last();
        $activity->log_name=$main_id;
        $activity->save();
    }



}
