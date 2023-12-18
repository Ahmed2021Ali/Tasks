<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
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

    public $user;


    public function __construct()
    {
        $this->user = new User();
        $this->middleware('permission:user.store', ['only' => ['store']]);
        $this->middleware('permission:user.update', ['only' => ['update']]);
        $this->middleware('permission:user.destroy', ['only' => ['destroy']]);
        $this->middleware('permission:user.report_of_user', ['only' => ['report_of_user']]);
    }

    public function index()
    {
        return view('user.index', [
            'users' => $this->user->getAllUsers(),
            'roles' => Role::pluck('name', 'name')->all()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([...$request->validated()]);
        $user->assignRole($request->input('role'));
        Report::create(['user_id' => $user->id,]);
        return redirect()->back();
    }

    public function update(UpdateUserRequest $request, $user)
    {
        $user->update($request->validated());
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('role'));
        return redirect()->back();
    }

    public function destroy($user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function report_of_user($id)
    {
        $this->report($id);
        $report = Report::where('user_id', $id)->first();
        $tasks = Task::where('assigned_to', '=', $id)->where('type', 'main')->OrWhere('type', 'sub')->get();
        return view('user.report', compact('report', 'tasks'));
    }
}
