<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px;
        }

        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        main {
            padding: 20px;
        }

        table {
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            text-align: center;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .custom-btn {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;

        }
    </style>
</head>

<body>
    <header>
        <h3>Task List</h3>
    </header>
    <main>
        <div class="col-md-4">
            <form action="{{ url('/taskList') }}" method="POST" class="form-inline">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="searchItem" value="{{ $search }}"
                        id="searchItem" aria-describedby="helpId" placeholder="Search...">
                    &nbsp;
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary btn-sm" value="Search">
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table
                class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
                <thead class="table-light">
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Task Created Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @for ($i = 0; $i < count($createdTasks); $i++)
                        <tr class="table-primary">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $createdTasks[$i]['title'] }}</td>
                            <td>{{ $createdTasks[$i]['description'] }}</td>
                            <td>{{ $createdTasks[$i]['due_date'] }}</td>
                            <td>{{ $createdTasks[$i]['created_at'] }}</td>
                            <td>
                                @if ($createdTasks[$i]['status'] == 1)
                                    <a name="" id="" class="btn btn-secondary btn-sm"
                                        href="javascript:void(0)" role="button">New Task</a>
                                @elseif ($createdTasks[$i]['status'] == 2)
                                    <a name="" id="" class="btn btn-success btn-sm"
                                        href="javascript:void(0)" role="button">Task Completed</a>
                                @endif
                            </td>
                            <td>
                                @if ($createdTasks[$i]['status'] == 1)
                                    <a name="" id="" href="javascript:void(0)"
                                        class="btn btn-warning btn-sm"
                                        onclick="completeTask('{{ $createdTasks[$i]['id'] }}')" role="button">Complete the task</a>
                                
                                    <a name="" id="" href="javascript:void(0)"
                                        class="btn btn-primary btn-sm" onclick="editTask('{{ $createdTasks[$i]['id'] }}')"
                                        role="button">Edit</a>

                                    <a name="" id="" href="javascript:void(0)"
                                        class="btn btn-primary btn-sm" onclick="deleteTask('{{ $createdTasks[$i]['id'] }}')"
                                        role="button">Delete</a>
                                @endif
                            </td>

                        </tr>
                    @endfor

                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        {{ $createdTasks->links('pagination.custom') }}

        <a href="{{ url('/createView') }}" class="btn btn-primary btn-sm custom-btn" role="button">
            Create Task
        </a>
        <br>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        const editTask = (id) => {
            var token = '{{ csrf_token() }}';

            var form = document.createElement('form');
            form.action = '/editTask';
            form.method = 'POST';
            form.target = '_blank';

            var textField1 = document.createElement('input');
            textField1.type = 'hidden';
            textField1.name = 'id';
            textField1.value = id;
            form.appendChild(textField1);

            var textField2 = document.createElement('input');
            textField2.type = 'hidden';
            textField2.name = '_token';
            textField2.value = token;
            form.appendChild(textField2);

            document.body.appendChild(form);
            form.submit();

        }

        const deleteTask = (id) => {
            var token = '{{ csrf_token() }}';
            $.ajax({
                    url: '/deleteTask',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                })
                .done(function(response) {
                    console.log('Success:', response);
                    alert(response.msg);
                    window.location.reload();
                });
        }

        const completeTask = (id) => {
            var token = '{{ csrf_token() }}';
            $.ajax({
                    url: '/completeTask',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                })
                .done(function(response) {
                    console.log('Success:', response);
                    alert(response.msg);
                    window.location.reload();
                });
        }
    </script>
</body>

</html>
