<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\updateClientRequest;
use Spatie\Activitylog\Models\Activity;

class ClientController extends Controller
{
    public $client;
    public function __construct()
    {
        $this->client = new Client;

        $this->middleware('permission:client.store', ['only' => ['store']]);
        $this->middleware('permission:client.update', ['only' => ['update']]);
        $this->middleware('permission:client.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view("client.index",[
            'clients' => $this->client->getAllClients(),
            ]);
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->back()->with(['success'=>'Save successfully']);
    }

    public function update(updateClientRequest $request ,$client)
    {
        $client->update($request->validated());
        return redirect()->back()->with(['success'=>'Update successfully']);
    }

    public function destroy($client)
    {
        $client->delete();
        return redirect()->back()->with(['success'=>'Delete successfully']);
    }
}
