@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Report</h1>
@stop

@section('content')
    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">Info User</h3>
            <h4 class="card-text">Name : {{ $report->user->name }}</h4>
            <h4 class="card-text">Phone : {{ $report->user->phone }}</h4>
            <h4 class="card-text">Email : {{ $report->user->email }}</h4>
        </div>
    </div>

    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">
                <h5 class="card-title">Reort : {{ $report->user->name }}</h5>
            </h3>
            <h4 class="card-text">
                Total Tasks =
                @if (isset($report->task_created))
                    <span style="color:blue">{{ $report->task_created }}</span>
                @else
                    <span style="color:red">Not Found</span>
                @endif
            </h4>
            <h4 class="card-text">
                Total Task Has done =
                @if (isset($report->task_done))
                    <span style="color:blue">{{ $report->task_done }} </span>
                @else
                    <span style="color:red">Not Found</span>
                @endif
            </h4>
            <h4 class="card-text">
                Rate =
                @if (isset($report->Rate))
                    <span style="color:blue">{{ $report->Rate }} % </span>
                @else
                    <span style="color:red">Not Found</span>
                @endif
            </h4>
        </div>
    </div>

    <h3>Tasks ( Assigned To )</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Task</th>
                <th scope="col">Title Task</th>
                <th scope="col">Dateline</th>
                <th scope="col">Assined By</th>
                <th scope="col">Assined To</th>
                <th scope="col">Status</th>
                <th scope="col">File</th>
                <th scope="col">Time Upload File</th>
                <th scope="col">Delay in delivery of the task</th>
            </tr>
        </thead>
        @foreach ($tasks as $task)
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><a href="{{ route('sub.index',$task->main_id) }}" type="button" class="btn btn-success">Show Task</a></td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->dateline }}</td>
                    <td>{{ $task->assigned_by_user->name }}</td>
                    <td>{{ $task->assigned_to_user->name }}</td>
                    <td>{{ $task->status == null ? 'No Completed' : 'Completed' }}</td>
                    <td>{{ $task->file == null ? 'No' : 'Done' }}</td>
                    <td>{{ $task->delivery_time}}</td>
                    <td>{{ $task->delay_upload_file}}</td>
                </tr>
            </tbody>
        @endforeach
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
