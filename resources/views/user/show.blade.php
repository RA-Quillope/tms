@extends('layout')
@section('main-content')
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
