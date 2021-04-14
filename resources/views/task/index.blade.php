@extends('layout')
@section('main-content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">Tasks</h4>
        </div>
        <div class="float-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                id="show-task-modal">
                Add task
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('task.store') }}" method="post" id="task-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <input type="text" name="desc" id="desc" class="form-control form-control-sm">
                                </div>
                                <div class="form-group" id="user-for-task">
                                    <label for="user">User</label>
                                    <select name="user_id" id="user_id" list="datalistOptions"
                                        class="form-control form-control-sm" placeholder="Type to search...">
                                        <datalist id="datalistOptions">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->firstname . ' ' . $user->lastname }}
                                                </option>
                                            @endforeach
                                        </datalist>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add-task">Add</button>
                            <button type="button" class="btn btn-primary" id="save-task">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div id="task-data" class="task-table-container">
        @include('task.pagination')
    </div>
@endsection
