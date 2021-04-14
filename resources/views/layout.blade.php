<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Laravel</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/new-php-logo.svg" alt="" width="50" height="50" class="d-inline-block align-text">
                Task Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 50px;">

                    <li class="nav-item">
                        <a class="nav-link" href="/user">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Manage Tasks</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-5">
        @yield('main-content')

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
    </div>

</body>

</html>

{{-- AJAX SCRIPT --}}
<script type="text/javascript">
    $(document).ready(function() {
        let user_id;
        let task_id;
        // TASK PAGINATION
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            console.log(page)
            fetch_task_data(page);
        });

        function fetch_task_data(page) {
            $.ajax({
                url: "fetch_task_data?page=" + page,
                success: function(data) {
                    $('#task-data').html(data);
                }
            });
        }

        // USER PAGINATION
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_user_data(page);
        });

        function fetch_user_data(page) {
            $.ajax({
                url: "fetch_user_data?page=" + page,
                success: function(data) {
                    $('#user-data').html(data);
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // USER

        // SHOW ADD USER MODAL
        $(document).on("click", "#show-user-modal", function(e) {
            $("#save-user").hide();
            $("#add-user").show();
            $('#user-form').trigger("reset");

        });


        // ADD USER
        $(document).on("click", "#add-user", function(e) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            if (firstname != "" && lastname != "") {
                $.ajax({
                    url: "/user",
                    method: 'POST',
                    cache: false,
                    dataType: "json",
                    data: {
                        _token: $("#csrf").val(),
                        type: 3,
                        firstname: firstname,
                        lastname: lastname
                    },
                    success: function(response) {
                        if (response) {
                            $('#user-form').trigger("reset");
                            $('#exampleModal2').modal('hide');
                            $('.user-table-container').load("/fetch_user_data",
                                function() {
                                    $('.user-table-container').fadeIn();
                                });
                        } else {
                            alert("Error occured !");
                        }
                    }
                });
            }
        });

        // SHOW EDIT USER MODAL
        $(document).on("click", "#show-edit-user-modal", function(e) {
            $("#save-user").show();
            $("#add-user").hide();

            var firstname = $(this).data("firstname");
            var lastname = $(this).data("lastname");
            user_id = $(this).data("id");
            $("#exampleModal2").modal('show');
            $(".modal-body #firstname").val(firstname);
            $(".modal-body #lastname").val(lastname);

        });

        //EDIT USER
        $(document).on("click", "#save-user", function(e) {

            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var token = $("meta[name='csrf-token']").attr("content");

            if (firstname != "" && lastname != "") {
                $.ajax({
                    url: "user/" + user_id,
                    method: 'PATCH',
                    dataType: "json",
                    cache: false,
                    data: {
                        _token: token,
                        firstname: firstname,
                        lastname: lastname,
                        id: user_id
                    },
                    success: function(response) {
                        if (response) {
                            $('#user-form').trigger("reset");
                            $('#exampleModal2').modal('hide');
                            $('.user-table-container').load("/fetch_user_data",
                                function() {
                                    $('.user-table-container').fadeIn();
                                });
                        } else {
                            alert("Error occured !");
                        }

                    }

                });

            }
            e.stopPropagation();
        });

        // DELETE USER
        $(document).on('click', "#delete-user", function(e) {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: "user/" + id,
                type: 'DELETE',
                dataType: "json",
                data: {
                    _token: token,
                    id: id
                },
                cache: false,
                success: function(response) {
                    if (response) {
                        $('#user-form').trigger("reset");
                        $('#exampleModal2').modal('hide');
                        $('.user-table-container').load("/fetch_user_data",
                            function() {
                                $('.user-table-container').fadeIn();
                            });
                    } else {
                        alert("Error occured !");
                    }
                }
            });
        });


        // TASK

        // SHOW ADD TASK MODAL
        $(document).on("click", "#show-task-modal", function(e) {
            $("#save-task").hide();
            $("#add-task").show();
            $('#task-form').trigger("reset");

        });

        // ADD TASK
        $("#add-task").click(function(e) {

            var title = $('#title').val();
            var desc = $('#desc').val();
            var user_id = $('#user_id').val();

            if (title != "" && desc != "" && user_id != "") {
                $.ajax({
                    url: "/task",
                    method: 'POST',
                    data: {
                        _token: $("#csrf").val(),
                        title: title,
                        desc: desc,
                        user_id: user_id
                    },
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            console.log('It works')
                            $('#task-form').trigger("reset");
                            $('#exampleModal').modal('hide');
                            $('.task-table-container').load("/fetch_task_data",
                                function() {
                                    $('.task-table-container').fadeIn();
                                });
                        } else {
                            alert("Error occured !");
                        }

                    }

                });
            }
        });

        // SHOW EDIT TASK MODAL
        $(document).on("click", "#show-edit-task-modal", function(e) {
            $("#save-task").show();
            $("#add-task").hide();
            $("#user-for-task").hide();


            var title = $(this).data("title");
            var desc = $(this).data("desc");
            task_id = $(this).data("id");
            $("#exampleModal").modal('show');
            $(".modal-body #title").val(title);
            $(".modal-body #desc").val(desc);

        });

        //EDIT TASK
        $(document).on("click", "#save-task", function(e) {

            var title = $('#title').val();
            var desc = $('#desc').val();
            var token = $("meta[name='csrf-token']").attr("content");

            if (title != "" && desc != "") {
                $.ajax({
                    url: "task/" + task_id,
                    method: 'PATCH',
                    dataType: "json",
                    cache: false,
                    data: {
                        _token: token,
                        title: title,
                        desc: desc,
                        id: task_id
                    },
                    success: function(response) {
                        if (response) {
                            $('#task-form').trigger("reset");
                            $('#exampleModal').modal('hide');
                            $('.task-table-container').load("/fetch_task_data",
                                function() {
                                    $('.task-table-container').fadeIn();
                                });
                        } else {
                            alert("Error occured !");
                        }

                    }

                });

            }
            e.stopPropagation();
        });

        // DELETE TASK
        $(document).on('click', "#delete-task", function(e) {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            console.log(token)
            $.ajax({
                url: "task/" + id,
                type: 'DELETE',
                dataType: "json",
                data: {
                    _token: token,
                    id: id
                },
                cache: false,
                success: function(response) {
                    if (response) {
                        console.log('It works')
                        $('#task-form').trigger("reset");
                        $('#exampleModal').modal('hide');
                        $('.task-table-container').load("/fetch_task_data",
                            function() {
                                $('.task-table-container').fadeIn();
                            });
                    } else {
                        alert("Error occured !");
                    }
                }
            });
        });


    });

</script>
