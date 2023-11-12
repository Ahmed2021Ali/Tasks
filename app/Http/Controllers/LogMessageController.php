<?php

namespace App\Http\Controllers;

use App\Http\traits\media;
use App\Models\LogMessage;
use Illuminate\Http\Request;

class LogMessageController extends Controller
{
    use media;
    public function notify($id)
    {
       $log_message=LogMessage::where("id", $id)->first();

       if($log_message->client_id)
       {
            $this->notify_all_again($log_message);
       }
       else
       {
            $this->notify_without_client_again($log_message);
       }
       return redirect()->back()->with(['success'=>'Send Notify Again']);
    }
}
