@extends('layout')
@section('main-content')
    <form action="{{ route('user.update', $user->id) }}" method="post">
        {{ csrf_field() }}
        @method('PUT')
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm"
                value="{{ $user->firstname }}">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm"
                value="{{ $user->lastname }}">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
