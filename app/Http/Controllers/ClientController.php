<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\updateClientRequest;
use Spatie\Activitylog\Models\Activity;

class ClientController extends Controller
{
    public function index()
    {
        $clients=Client::all();
        return view("client.index",compact('clients'));
    }
    public function store(StoreClientRequest $request)
    {
        $data=$request->except(['_token','conform']);
        Client::create($data);
        return redirect()->back()->with(['success'=>'Save successfully']);
    }
    public function update(updateClientRequest $request ,$id)
    {
        Client::where('id',$id)->update($request->except(['_token','_method']));
        return redirect()->back()->with(['success'=>'Update successfully']);
    }
    public function destroy($id)
    {
        Client::where('id',$id)->delete();
        return redirect()->back()->with(['success'=>'Delete successfully']);
    }
}
