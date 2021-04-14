<table class="table table-hover" id="user-table">
    <thead>
        <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Number of tasks</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="col-md-3">{{ $user->firstname }}</td>
                <td class="col-md-3">{{ $user->lastname }}</td>
                <td class="col-md-3">{{ $user->tasks->count() }}</td>
                <td class="col-md-3">
                    <a href="{{ route('user.show', $user->id) }}" type="button" class="btn btn-primary"">
                        Show
                    </a>
                    <button type=" button" class="btn btn-warning" id="show-edit-user-modal"
                        data-firstname="{{ $user->firstname }}" data-lastname="{{ $user->lastname }}"
                        data-id="{{ $user->id }}">
                        Edit
                        </button>
                        <form action="{{ route('user.destroy', [$user]) }}" style="display:inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete" id="delete-user"
                                data-id="{{ $user->id }}">
                                Delete
                            </button>
                        </form>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
