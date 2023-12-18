@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-3xl mt-4 mb-8"> Create Role </h1>
@stop

@section('content')
    <div class="pull-right">
        <x-adminlte-modal id="create" title="Add Role" theme="purple" icon="fas fa-bolt" size='lg'
                          disable-animations>
            @include('roles.create',['permission'=>$permission])
            <x-slot name="footerSlot">
            </x-slot>
        </x-adminlte-modal>
        <x-adminlte-button label="Create Role" data-toggle="modal" data-target="#create"
                           class="bg-purple"/>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $role->name }}</td>
                <td>

                    <x-adminlte-modal id="edit_{{$role->id}}" title="Edit Role" theme="purple"
                                      icon="fas fa-bolt" size='lg'
                                      disable-animations>
                        @include('roles.edit',['role'=>$role,'permission'=>$permission])
                        <x-slot name="footerSlot">
                        </x-slot>
                    </x-adminlte-modal>
                    <x-adminlte-button label="Edit Role" data-toggle="modal" data-target="#edit_{{$role->id}}"
                                       class="bg-purple"/>

                    <a class="btn btn-info" href="{{ route('role.show',$role) }}">Permissions</a>
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

@stop

@section('js')
    <script>
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@stop

