@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create client</h1>
@stop

@section('content')
    <x-message-component />
    <x-adminlte-modal id="create" title="Add Client" theme="purple" icon="fas fa-bolt" size='lg' disable-animations>
        @include('client.create')
        <x-slot name="footerSlot">
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-button label="Create Client" data-toggle="modal" data-target="#create" class="bg-purple" />
    <br>
    <div class="row">
        <div class="col-12">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->name }}</td>
                            <th>{{ $client->phone }}</th>
                            <td>
                                <x-adminlte-modal id="edit_{{ $client->id }}" title="edit Client" theme="purple" icon="fas fa-bolt"
                                    size='lg' disable-animations>
                                    @include('client.edit', ['client' => $client])
                                    <x-slot name="footerSlot">
                                    </x-slot>
                                </x-adminlte-modal>
                                <x-adminlte-button label="edit" data-toggle="modal" data-target="#edit_{{ $client->id }}"
                                    class="bg-purple" />

                                <x-adminlte-modal id="delete_{{ $client->id }}" title="delete" theme="purple" icon="fas fa-bolt"
                                    size='lg' disable-animations>
                                    <form action="{{ route('client.destroy', $client->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <h3> Are you sure to delete ? </h3>
                                        <button class="btn btn-danger btn-lg btn-block"> Yes </button>
                                    </form>
                                    <x-slot name="footerSlot">
                                    </x-slot>
                                </x-adminlte-modal>
                                <x-adminlte-button label="delete" data-toggle="modal" data-target="#delete_{{ $client->id }}"
                                    class="bg-purple" />
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop
