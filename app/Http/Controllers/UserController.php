<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Report;
use App\Http\traits\media;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use media;
    public function index()
    {
        $users=User::all();
        return view('user.index',compact('users'));
    }
    public function store(StoreUserRequest $request)
    {
        $data=$request->except(['_token','password_confirmation']);
       $user= User::create($data);
        Report::create([
            'user_id'=>$user->id,
        ]);
        return redirect()->back();
    }
    public function update(UpdateUserRequest $request ,$id)
    {
         User::where('id',$id)->update($request->except(['_token','password_confirmation','_method']));
        return redirect()->back();
    }
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back();
    }
    public function report_of_user($id)
    {
       $this->report($id);
       $report= Report::where('user_id',$id)->first();
       $tasks=Task::where('assigned_to','=',$id)->where('type','main')->OrWhere('type','sub')->get();
       return view('user.report',compact('report','tasks'));
    }
}
