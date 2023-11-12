@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Add Task</h1>
@stop

@section('content')

    <div class="card border-primary mb-5 mt-3">
        <div class="card-header">
            <h4> Client Name : {{ $main_task->client->name}}</h4>
        </div>

        <div class="card-body text-primary">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5 class="card-text">Title Task : {{ $main_task->title }}</h5>
                    <h5 class="card-text"> Description Task :{{ $main_task->description }}</h5>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h5 class="card-text">Request Date : {{ $main_task->request_at }}</h5>
                    <h5 class="card-text">Date Line : {{ $main_task->dateline }}</h5>

                </div>
            </div>
        </div>
    </div>
    <x-message-component />

    <x-adminlte-modal id="add_Sub_task" title="Add  Sub Task" theme="purple" icon="fas fa-bolt" size='lg'
        disable-animations>
        @include('livewire.sub_task.create', ['users' => $users])
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="Add SubTask" data-toggle="modal" data-target="#add_Sub_task" class="bg-purple" />

    <form wire:submit.prevent="submit">
        <input type="text" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <input type="text" wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save Contact</button>
    </form>
    
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Request_at</th>
                        <th scope="col">Dateline</th>
                        <th scope="col">Extend Request</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Assigned By</th>
                        <th scope="col">Notify Client</th>
                        <th scope="col">File</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sub_tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->client->name }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <th>{{ $task->request_at }}</th>
                            <th>{{ $task->dateline }}</th>
                            <th>{{ $task->extend_request }}</th>
                            <th>{{ $task->assigned_to_user?->name }}</th>
                            <th>{{ $task->assigned_by_user?->name }}</th>
                            <th>{{ $task->notify == 1 ? 'Done' : 'No' }}</th>
                            <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                            <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
