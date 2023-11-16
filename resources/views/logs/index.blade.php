<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Description</th>
                <th scope="col">Causer</th>
                <th scope="col">properties</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($logs as $log )
                <tr>
                    <td> {{ $loop->iteration }}</td>
                    <td>  {{ $log['description'] }}</td>
                    <th>  {{ $log->causer->name }}</th>
                    <th>
                        @foreach($log->properties as $properties)
                            <ul>
                                @if(isset($properties['type']))
                                    <li>
                                        Type Task : {{  $properties['type'] }} Task
                                    </li>
                                @endif
                                @if(isset($properties['status']))
                                    @if($properties['status'] == '0')
                                        <li> status : Not Completed</li>

                                    @elseif($properties['status'] == '1')
                                        <li> status : Completed</li>
                                    @endif
                                @endif
                                @if(isset($properties['title']))
                                    <li>
                                        Title : {{  $properties['title'] }}
                                    </li>
                                @endif
                                @if(isset($properties['description']))
                                    <li>
                                        description : {{  $properties['description'] }}
                                    </li>
                                @endif
                                @if(isset($properties['request_at']))
                                    <li>
                                        request_at : {{  $properties['request_at'] }}
                                    </li>
                                @endif
                                @if(isset($properties['dateline']))
                                    <li>
                                        dateline : {{  $properties['dateline'] }}
                                    </li>
                                @endif
                                @if(isset($properties['file']))
                                    <li>
                                        file : {{  $properties['file'] }}
                                    </li>
                                @endif
                                @if(isset($properties['delivery_time']))
                                    <li>
                                        delivery_time : {{  $properties['delivery_time'] }}
                                    </li>
                                @endif
                                @if(isset($properties['delay_upload_file']))
                                    <li>
                                        delay_upload_file : {{  $properties['delay_upload_file'] }}
                                    </li>
                                @endif
                                @if(isset($properties['task_id']))
                                    <li>
                                        Message : {{$properties['message']}}
                                    </li>
                                    <li>
                                        Notify : {{$properties['status']}}
                                    </li>
                                @endif
                            </ul>
                        @endforeach
                    </th>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

