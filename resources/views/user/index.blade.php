@extends('layout')
@section('main-content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">Users</h4>
        </div>
        <div class="float-end">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                id="show-user-modal">
                Add User
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Add user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.store') }}" method="post" id="user-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add-user">Add</button>
                            <button type="button" class="btn btn-primary" id="save-user">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>

    <div id="user-data" class="user-table-container">
        @include('user.pagination')
    </div>



@endsection
