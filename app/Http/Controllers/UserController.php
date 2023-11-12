<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('user.index',compact('users'));
    }
    public function store(StoreUserRequest $request)
    {
        $data=$request->except(['_token','password_confirmation']);
       $user= User::create($data);
/*         Report::create([
            'user_id'=>$user->id,
        ]); */
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
}
