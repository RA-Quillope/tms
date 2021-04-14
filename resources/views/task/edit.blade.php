@extends('layout')
@section('main-content')
    <form action="{{ route('task.update', $task->id) }}" method="post">
        {{ csrf_field() }}
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-sm" value="{{ $task->title }}">
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <input type="text" name="desc" id="desc" class="form-control form-control-sm" value="{{ $task->desc }}">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
