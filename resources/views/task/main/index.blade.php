@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Add Task</h1>
@stop

@section('content')
     <x-message-component />

    <x-adminlte-modal id="modalPurple" title="Add  Main Task" theme="purple" icon="fas fa-bolt" size='lg'
        disable-animations>
        @include('task.main.create', ['users' => $users, 'clients' => $clients])
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="Add Task" data-toggle="modal" data-target="#modalPurple" class="bg-purple" />

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
                        <th scope="col">Notify</th>
                        <th scope="col">File</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($main_tasks as $task)
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
                            <th>
                                @if($task->messageLog)
                                @if($task->messageLog->client_id)
                                Client : {{ $task->messageLog->status  }}
                                <br>
                                @endif
                                @if($task->messageLog->assigned_to)
                                Assigned_to : {{ $task->messageLog->status  }}
                                <br>
                                @endif
                                @if($task->messageLog->assigned_by)
                                Assigned_by : {{ $task->messageLog->status  }}
                                @endif
                                @endif
                            </th>
                            <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                            <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                            <td>
                            <a href="{{ route('sub.index', $task->main_id) }}" class="btn btn-info">Follow Up</a>
                      </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $main_tasks->links() }}
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


