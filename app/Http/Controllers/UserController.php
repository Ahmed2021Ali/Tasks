<?php

namespace App\Http\Controllers;

use App\Events\UserNotification;
use App\Models\Task;
use App\Models\User;
use App\Models\Report;
use App\Http\traits\media;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\DB;
use Kutia\Larafirebase\Services\Larafirebase;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use media;

    public function __construct()
    {
        $this->middleware('permission:user.store', ['only' => ['store']]);
       // $this->middleware('permission:user.update', ['only' => ['update']]);
        $this->middleware('permission:user.destroy', ['only' => ['destroy']]);
        $this->middleware('permission:user.report_of_user', ['only' => ['report_of_user']]);

    }

    public function index()
    {
        $users=User::all();
        $roles = Role::pluck('name','name')->all();
        return view('user.index',compact('users','roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data=$request->except(['_token','password_confirmation']);
          $user= User::create([
              ...$data,
              'fcm_token'=>$request->_token,
              ]);
        $user->assignRole($request->input('role'));
        Report::create([
            'user_id'=>$user->id,
        ]);
        return redirect()->back();
    }

    public function update(UpdateUserRequest $request ,$id)
    {
        User::where('id',$id)->update($request->except(['_token','password_confirmation','_method']));
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('role'));
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
