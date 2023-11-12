<?php

namespace App\Http\traits;

use App\Models\LogMessage;
use Illuminate\Support\Facades\Artisan;

trait media
{

    // operation store task , Notify all user (Assigned To and Assigned By) and client
    public function notify_all_operation_store_task($task)
    {
        try
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
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$message,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Done',
                'main_id'=>$task->main_id,
            ]);
        }
         catch (\Exception $e)
        {
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$message,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Failed',
                'main_id'=>$task->main_id,
            ]);
        }
    }

    // operation store task , Notify all user (Assigned To and Assigned By)
    public function notify_without_client_operation_store_task($task)
    {
        try
        {
            $message=$task->title;
            //send message to assigned_to_user
            $phone_assigned_to_user=$task->assigned_to_user->phone;
            //send message to assigned_by_user
            $phone_assigned_by_user=$task->assigned_by_user->phone;

            dispatch(function() use ($phone_assigned_to_user,$phone_assigned_by_user,$message){
              Artisan::call('app:notify-client', ['phone' => $phone_assigned_to_user, 'message' => $message]);
              Artisan::call('app:notify-client', ['phone' => $phone_assigned_by_user, 'message' => $message]);
          });
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$message,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Done',
                'main_id'=>$task->main_id,
            ]);
        }
         catch (\Exception $e)
        {
            LogMessage::create([
                'task_id'=>$task->id,
                'message'=>$message,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Failed',
                'main_id'=>$task->main_id,
            ]);
        }
    }

    // operation update task , Notify all user (Assigned To and Assigned By)
     public function notify_without_client_operation_update_task($task)
    {
            try
            {
                $message=$task->title;
                //send message to assigned_to_user
                $phone_assigned_to_user=$task->assigned_to_user->phone;
                //send message to assigned_by_user
                $phone_assigned_by_user=$task->assigned_by_user->phone;

                dispatch(function() use ($phone_assigned_to_user,$phone_assigned_by_user,$message){
                Artisan::call('app:notify-client', ['phone' => $phone_assigned_to_user, 'message' => $message]);
                Artisan::call('app:notify-client', ['phone' => $phone_assigned_by_user, 'message' => $message]);
                });
                LogMessage::where('task_id', $task->id)->update([
                    'task_id'=>$task->id,
                    'message'=>$message,
                    'assigned_to'=>$task->assigned_to,
                    'assigned_by'=>$task->assigned_by,
                    'status'=>'Done'
                ]);
            }
             catch (\Exception $e)
            {
                LogMessage::where('task_id', $task->id)->update([
                    'task_id'=>$task->id,
                    'message'=>$message,
                    'assigned_to'=>$task->assigned_to,
                    'assigned_by'=>$task->assigned_by,
                    'status'=>'Failed'
                ]);
            }
    }

    // operation update task , Notify all user (Assigned To and Assigned By) and client
    public function notify_all_operation_update_task($task)
    {
        try
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
            LogMessage::where('task_id', $task->id)->update([
                'task_id'=>$task->id,
                'message'=>$message,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Done'
            ]);
        }
         catch (\Exception $e)
        {
            LogMessage::where('task_id', $task->id)->update([
                'task_id'=>$task->id,
                'message'=>$message,
                'client_id'=>$task->client_id,
                'assigned_to'=>$task->assigned_to,
                'assigned_by'=>$task->assigned_by,
                'status'=>'Failed'
            ]);
        }
    }

    // operation update task , Notify  client Only
    public function notify_client_only_operation_update_task($task)
    {
        try
        {
            $message=$task->title;
            // send message to client
            $phone_client=$task->client->phone;
            // dd($phone_client,$message_client,$phone_assigned_to_user,$message_assigned_to_user,$phone_assigned_by_user,$message_assigned_by_user);
             dispatch(function() use ($phone_client,$message){
                Artisan::call('app:notify-client', ['phone' => $phone_client, 'message' => $message]);
            });
                LogMessage::where('task_id',$task->id)->update([
                    'task_id'=>$task->id,
                    'message'=>$message,
                    'client_id'=>$task->client_id,
                    'status'=>'Done'
                ]);
            }
             catch (\Exception $e)
            {
                LogMessage::where('task_id',$task->id)->update([
                    'task_id'=>$task->id,
                    'message'=>$message,
                    'client_id'=>$task->client_id,
                    'status'=>'Failed'
                ]);
            }
    }
    public function notify_all_again($log_message)
    {
        try
        {
            $message=$log_message->message;
            // send message to client
            $phone_client=$log_message->client->phone;
            // send message to assigned_to_user
            $phone_assigned_to_user=$log_message->assigned_to_user->phone;
            // send message to assigned_by_user
            $phone_assigned_by_user=$log_message->assigned_by_user->phone;
            // dd($phone_client,$message_client,$phone_assigned_to_user,$message_assigned_to_user,$phone_assigned_by_user,$message_assigned_by_user);
           dispatch(function() use ($phone_client,$phone_assigned_to_user,$phone_assigned_by_user,$message){
            Artisan::call('app:notify-client', ['phone' => $phone_client, 'message' => $message]);
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_to_user, 'message' => $message]);
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_by_user, 'message' => $message]);
           });
            LogMessage::where('id', $log_message->id)->update([
                'status'=>'Done'
            ]);
        }
         catch (\Exception $e)
         {
            LogMessage::where('id', $log_message->id)->update([
                'status'=>'Failed'
            ]);
        }
    }
    public function notify_without_client_again($log_message)
    {
        try
        {
            $message=$log_message->message;
            // send message to assigned_to_user
            $phone_assigned_to_user=$log_message->assigned_to_user->phone;
            // send message to assigned_by_user
            $phone_assigned_by_user=$log_message->assigned_by_user->phone;
            // dd($phone_client,$message_client,$phone_assigned_to_user,$message_assigned_to_user,$phone_assigned_by_user,$message_assigned_by_user);
           dispatch(function() use ($phone_assigned_to_user,$phone_assigned_by_user,$message){
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_to_user, 'message' => $message]);
            Artisan::call('app:notify-client', ['phone' => $phone_assigned_by_user, 'message' => $message]);
           });
            LogMessage::where('id', $log_message->id)->update([
                'status'=>'Done'
            ]);
        }
         catch (\Exception $e)
         {
            LogMessage::where('id', $log_message->id)->update([
                'status'=>'Failed'
            ]);
        }
    }


}
