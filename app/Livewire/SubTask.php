<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Computed;

class SubTask extends Component
{

    public $main_id;
    public $main_task;
    public $sub_tasks;
    public $users;
    public $clients;

    //public SelectActionForm $form;

    public $title;
/*     public $description;
    public $request_at;
    public $dateline; */
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function submit()
    {
        dd("aaa");
    }


    public function mount($main_id)
    {
        $this->main_id=$main_id;

        $user=new User();
        $this->users=$user->get_users();

        $client=new Client();
        $this->clients=$client->get_clients();

        $this->main_task = Task::where('type','main')->where('main_id',$main_id)->first();
        $this->sub_tasks = Task::where('main_id',$main_id)->get();

    }
    public function create_sub_task()
    {
        dd("aaaaaaa");
        dd($this->title);
    }
    public function render()
    {
        return view('livewire.sub-task')->layout('layouts.app');
    }
}
