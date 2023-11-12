@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Report user</h1>
@stop

@section('content')
 <div class="card-body">
        <h3>Total Tasks =
            @if (isset($report->task_created))
                {{ $report->task_created }}
            @else
                <h3 style="color:red">Not Found</h3>
            @endif
        </h3>
    </div>
    <div class="card-body">
        <h3>Total Task Has done = @if (isset($report->task_done))
                {{ $report->task_done }}
            @else
                <h3 style="color:red">Not Found</h3>
            @endif
        </h3>
    </div>
    <div class="card-body">
        <h3>Rate =
            @if (isset($report->Rate))
                {{ $report->Rate }}
            @else
                <h3 style="color:red">Not Found</h3>
            @endif
        </h3>
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
