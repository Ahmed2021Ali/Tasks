@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create user</h1>
@stop

@section('content')
    <x-message-component/>

    <x-adminlte-modal id="create" title="Add user" theme="purple" icon="fas fa-bolt" size='lg' disable-animations>
        @include('user.create',['roles'=>$roles])
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="CreateUser" data-toggle="modal" data-target="#create" class="bg-purple"/>

    <br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">UserName</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <th>{{ $user->phone }}</th>
                        <td>

                            {{--  Edit  --}}
                            <x-adminlte-modal id="edit_{{ $user->id }}" title="edit user" theme="purple"
                                              icon="fas fa-bolt" size='lg' disable-animations>
                                @include('user.edit', ['user' => $user,'roles'=>$roles])
                                <x-slot name="footerSlot">
                                </x-slot>
                            </x-adminlte-modal>
                            <x-adminlte-button label="Edit" data-toggle="modal"
                                               data-target="#edit_{{ $user->id }}" class="bg-purple"/>
                            {{--  End Edit  --}}

                            {{--  delete  --}}
                            <x-adminlte-modal id="delete_{{ $user->id }}" title="delete" theme="purple"
                                              icon="fas fa-bolt" size='lg' disable-animations>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <h3> Are you sure to delete ? </h3>
                                    <button class="btn btn-danger btn-lg btn-block"> Yes</button>
                                </form>
                                <x-slot name="footerSlot">
                                </x-slot>
                            </x-adminlte-modal>
                            <x-adminlte-button label="delete" data-toggle="modal"
                                               data-target="#delete_{{ $user->id }}" class="bg-purple"/>
                            {{-- End  delete  --}}

                            <a href="{{ route('user.report_of_user', $user->id) }}" class="btn btn-info">Report</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
