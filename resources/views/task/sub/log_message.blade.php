<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Message</th>
        <th scope="col">Client </th>
        <th scope="col">UserBy</th>
        <th scope="col">UserTo</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($log_messages as $log_message )
        <tr>
            
            <th scope="row">{{ $loop->iteration }}</th>

            <th scope="row">{{ $log_message->message }}</th>
            <td>
                @if(isset($log_message->client->name))
                {{ $log_message->client->name  }}
                @endif
            </td>

            <td>
                @if(isset($log_message->assigned_to_user->name))
                {{ $log_message->assigned_to_user->name  }}
                @endif
            </td>

            <td>
                @if(isset($log_message->status ))
                {{ $log_message->assigned_to_user->name  }}
                @endif
            </td>

            <td>{{ $log_message->status }}</td>

            <td>
                @if($log_message->status)
                  <a href="{{ route('log_message.notify', $log_message->id) }}" type="button" class="btn btn-info">Notify Again</a>
                @endif
            </td>

        </tr>
        @endforeach

    </tbody>
  </table>
