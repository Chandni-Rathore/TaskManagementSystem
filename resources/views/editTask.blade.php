<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <form id="editTaskForm" action="{{ route('saveEditTask', ['id' => $id]) }}" method="POST">
            @csrf
            @php
                $title = $taskDetails['title'];
                $description = $taskDetails['description'];
                $due_date = $taskDetails['due_date'];
            @endphp
            <h2>Modify Task</h2>

            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                    value="{{ $title }}" placeholder="Title">
                <span class="error">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description">{{ $description }}</textarea>
                <span class="error">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Due Date</label>
                <input type="text" class="form-control" name="dueDate" id="dueDate" aria-describedby="helpId"
                    value="{{ $due_date }}" placeholder="Due Date" autocomplete="off">
                <span class="text-danger">
                    @error('dueDate')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <button type="submit" class="btn btn-primary">Modify</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dueDate').datepicker({
                format: 'dd-M-yyyy',
                autoclose: true
            });
        });
    </script>
</body>

</html>
