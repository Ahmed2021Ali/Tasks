<form action="{{ route('task.delete', $task->id) }}" method="post" class="d-inline">
    @method('delete')
    @csrf
    <h3> Are you sure to delete ? </h3>
    <button class="btn btn-danger btn-lg btn-block"> Yes </button>
</form>
