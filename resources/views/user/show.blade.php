@extends('layout')
@section('main-content')
    {{-- <div class="modal fade" id="user-tasks" tabindex="-1" aria-labelledby="user-tasks-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-tasks-label">
                        <p id="user-tasks-title">
                            {{ $user->firstname }}'s Tasks
                        </p>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="user-tasks-table">
                    <div>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="col-md-5">{{ $task->title }}</td>
                                    <td class="col-md-5" style="word-wrap: break-word;min-width: 100px;max-width: 100px;">
                                        {{ $task->desc }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div> --}}
    <div id="user-tasks" class="user-tasks-container">
        <div>
            <div class="float-start">
                <h4 class="pb-3">
                    <p id="user-tasks-title">
                        {{ $user->firstname }}'s Tasks
                    </p>
                </h4>
            </div>
            <div class="clearfix"></div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="col-md-5">{{ $task->title }}</td>
                        <td class="col-md-5" style="word-wrap: break-word;min-width: 100px;max-width: 100px;">
                            {{ $task->desc }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
