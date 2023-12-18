@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        Add Task</h1>
@stop

@section('content')

    <div class="card border-primary mb-5 mt-3">
        <div class="card-header">
            <h4> Client Name : {{ $main_task->client->name }}</h4>
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

    {{--  Add SubTask  --}}
    <x-adminlte-modal id="create_sub_task" title="Add  Sub Task" theme="purple" icon="fas fa-bolt" size='lg'
        disable-animations>
        @include('task.sub.create', ['users' => $users, 'main_task' => $main_task])
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="Add SubTask" data-toggle="modal" data-target="#create_sub_task" class="bg-purple" />
    {{--  End add SubTask  --}}


    {{--  Edit MainTask  --}}
    <x-adminlte-modal id="edit_main_task_{{ $main_task->id }}" title="Edit Main Task" theme="purple" icon="fas fa-bolt"
        size='lg' disable-animations>
        @include('task.main.edit', ['users' => $users, 'main_task' => $main_task, 'clients' => $clients])
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="Edit Main Task" data-toggle="modal" data-target="#edit_main_task_{{ $main_task->id }}"
        class="bg-purple" />
    {{--  End Edit MainTask  --}}


    {{--  Log Message Task  --}}
    <x-adminlte-modal id="log_message_{{ $main_task->main_id }}" title="Log Messages" theme="purple" icon="fas fa-bolt"
        size='lg' disable-animations>
        @include('task.sub.log_message', ['log_messages' => $log_messages])
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="Log Messages" data-toggle="modal" data-target="#log_message_{{ $main_task->main_id }}"
        class="bg-purple" />
    {{--  End Log Message Task  --}}


    {{--  Logs  Task  --}}
        <x-adminlte-modal id="logs_{{ $main_task->main_id }}" title="Logs Task" size="lg" theme="teal"
                          icon="fas fa-bell" v-centered static-backdrop scrollable>
            @include('logs.index', ['logs' => $logs])
            <x-slot name="footerSlot">
            </x-slot>
        </x-adminlte-modal>
        <x-adminlte-button label="Logs Task" data-toggle="modal" data-target="#logs_{{ $main_task->main_id }}" class="bg-teal"/>
    {{--  End Logs  Task  --}}


    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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
                    @foreach ($sub_tasks as $task)
                        @if ($task->extended && ($task->type == 'option'))
                            @if ($task->assigned_to == auth()->user()->id)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <th>{{ $task->request_at }}</th>
                                    <th>{{ $task->dateline }}</th>
                                    <th>{{ $task->extend_request }}</th>
                                    <th>{{ $task->assigned_to_user?->name }}</th>
                                    <th>{{ $task->assigned_by_user?->name }}</th>
                                    <th>No Nodify</th>
                                    <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                                    <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                                    <td>
                                        <form action="{{ route('sub.extend_status', $task->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <button name="value" value="reject" class="btn btn-danger">Reject</button>
                                            <button name="value" value="prove" class="btn btn-info">Approve</button>
                                        </form>
                                    </td>
                                <tr>
                                @else
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <th>{{ $task->request_at }}</th>
                                    <th>{{ $task->dateline }}</th>
                                    <th>{{ $task->extend_request }}</th>
                                    <th>{{ $task->assigned_to_user?->name }}</th>
                                    <th>{{ $task->assigned_by_user?->name }}</th>
                                    <th>No Nodify</th>
                                    <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                                    <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                                    <td> Has Panding</td>
                                <tr>
                            @endif
                        @elseif($task->type == 'prove' && $task->extended != null)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <th>{{ $task->request_at }}</th>
                                <th>{{ $task->dateline }}</th>
                                <th>{{ $task->extend_request }}</th>
                                <th>{{ $task->assigned_to_user?->name }}</th>
                                <th>{{ $task->assigned_by_user?->name }}</th>
                                <th>No Nodify</th>
                                <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                                <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                                <td> Has Approved , Task Extended</td>
                            <tr>
                            @elseif($task->type == 'extended' && $task->extended == null)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <th>{{ $task->request_at }}</th>
                                <th>{{ $task->dateline }}</th>
                                <th>{{ $task->extend_request }}</th>
                                <th>{{ $task->assigned_to_user?->name }}</th>
                                <th>{{ $task->assigned_by_user?->name }}</th>
                                <th>
                                    @if ($task->messageLog)
                                        @if ($task->messageLog->client_id)
                                            Client : {{ $task->messageLog->status }}
                                        @endif
                                        <br>
                                        @if ($task->messageLog->assigned_to)
                                            Assigned To : {{ $task->messageLog->status }}
                                        @endif
                                        <br>
                                        @if ($task->messageLog->assigned_by)
                                            Assigned B y : {{ $task->messageLog->status }}
                                        @endif
                                    @endif
                                </th>
                                <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                                <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                                <td> Task Extended</td>
                            <tr>
                            @elseif($task->type == 'reject' && $task->extended != null)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <th>{{ $task->request_at }}</th>
                                <th>{{ $task->dateline }}</th>
                                <th>{{ $task->extend_request }}</th>
                                <th>{{ $task->assigned_to_user?->name }}</th>
                                <th>{{ $task->assigned_by_user?->name }}</th>
                                <th>No Nodify</th>
                                <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                                <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                                <td> Has Rejected , No Extended Task</td>
                            <tr>
                            @else
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <th>{{ $task->request_at }}</th>
                                <th>{{ $task->dateline }}</th>
                                <th>{{ $task->extend_request }}</th>
                                <th>{{ $task->assigned_to_user?->name }}</th>
                                <th>{{ $task->assigned_by_user?->name }}</th>
                                <th>
                                    @if ($task->messageLog)
                                        @if ($task->messageLog->client_id)
                                            Client : {{ $task->messageLog->status }}
                                            <br>
                                        @endif
                                        @if ($task->messageLog->assigned_to)
                                            Assigned_to : {{ $task->messageLog->status }}
                                            <br>
                                        @endif
                                        @if ($task->messageLog->assigned_by)
                                            Assigned_by : {{ $task->messageLog->status }}
                                        @endif
                                    @endif
                                </th>
                                <th>{{ $task->file == null ? 'No' : 'Done' }}</th>
                                <th>{{ $task->status == 0 ? 'Not Completed' : 'Completed' }}</th>
                                <td>

                                    @if (auth()->user()->id == $task->assigned_by)
                                        @if ($task->status == '0')
                                            {{--  SubTask edit  --}}
                                            <x-adminlte-modal id="edit_sub_task_{{ $task->id }}" title="Edit SubTask"
                                                theme="purple" icon="fas fa-bolt" size='lg' disable-animations>
                                                @include('task.sub.edit', [
                                                    'task' => $task,
                                                    'users' => $users,
                                                ])
                                                <x-slot name="footerSlot">
                                                </x-slot>
                                            </x-adminlte-modal>
                                            <x-adminlte-button label="Edit" data-toggle="modal"
                                                data-target="#edit_sub_task_{{ $task->id }}" class="bg-purple" />
                                            {{--  End SubTask edit  --}}

                                            @if ($task->file)
                                                <a href="{{ route('sub.status', $task) }}" type="button"
                                                    class="btn btn-warning">Status</a>
                                            @endif
                                        @endif

                                        @if ($task->file)
                                            <a href="{{ route('sub.download_file', $task) }}" type="button"
                                                class="btn btn-info">Preview file</a>
                                        @endif
                                        {{--  delete Main Task  --}}
                                        @if (auth()->user()->role == 'admin')
                                            <x-adminlte-modal id="delete_{{ $task->id }}" title="delete" theme="purple"
                                                icon="fas fa-bolt" size='lg' disable-animations>
                                                @include('task.main.delete', ['task' => $task])
                                                <x-slot name="footerSlot">
                                                </x-slot>
                                            </x-adminlte-modal>
                                            <x-adminlte-button label="delete" data-toggle="modal"
                                                data-target="#delete_{{ $task->id }}" class="bg-purple" />
                                        @endif
                                        {{--  delete Main Task  --}}
                                    @endif

                                    @if (auth()->user()->id == $task->assigned_to)
                                        @if ($task->status == '0')
                                            {{--  edit_extend_request  --}}

                                            <x-adminlte-modal id="edit_extend_request_{{ $task->id }}"
                                                title="Extend Request" theme="purple" icon="fas fa-bolt" size='lg'
                                                disable-animations>
                                                @include('task.sub.extend_request', [
                                                    'task' => $task,
                                                ])
                                                <x-slot name="footerSlot">
                                                </x-slot>
                                            </x-adminlte-modal>
                                            <x-adminlte-button label="Extend Request" data-toggle="modal"
                                                data-target="#edit_extend_request_{{ $task->id }}" class="bg-purple" />
                                            {{-- end edit_extend_request  --}}

                                            {{-- edit_file_request   --}}
                                            <x-adminlte-modal id="edit_file_request_{{ $task->id }}"
                                                title="Upload File" theme="purple" icon="fas fa-bolt" size='lg'
                                                disable-animations>
                                                @include('task.sub.add_file', ['task' => $task])
                                                <x-slot name="footerSlot">
                                                </x-slot>
                                            </x-adminlte-modal>
                                            <x-adminlte-button label="delivery" data-toggle="modal"
                                                data-target="#edit_file_request_{{ $task->id }}" class="bg-purple" />
                                            {{--  edit_file_request  --}}
                                        @else
                                            Task Completed
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
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
