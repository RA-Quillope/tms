<table class="table table-hover" style="word-wrap:break-word" id="taskTable">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td class="col-md-3">{{ $task->user->firstname . ' ' . $task->user->lastname }}</td>
                <td class="col-md-3">{{ $task->title }}</td>
                <td class="col-md-3" style="word-wrap: break-word;min-width: 10px;max-width: 10px;">
                    {{ $task->desc }}</td>
                <td class="col-md-3">
                    <button type="button" class="btn btn-warning" id="show-edit-task-modal"
                        data-title="{{ $task->title }}" data-desc="{{ $task->desc }}" data-id="{{ $task->id }}">
                        Edit
                    </button>
                    <form action="{{ route('task.destroy', $task) }}" style="display:inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" id="delete-task" data-id="{{ $task->id }}">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $tasks->links('pagination::bootstrap-4') }}
</div>
