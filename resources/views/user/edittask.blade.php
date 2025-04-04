<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">



    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #FF80AB;"> <!-- Purple -->
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Tasks</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, {{ $LoggedUserInfo->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link" style="border:none; background:none;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif

        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center text-primary">Edit Task</h2>
            </div>
        </div>

        <!-- Edit Task Form -->
        <div class="card shadow-lg rounded-4" style="background-color: #fce4ec;"> <!-- Soft Pink -->
            <div class="card-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $task->description) }}</textarea>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="completed" class="form-label">Status</label>
                        <select class="form-select" id="completed" name="completed" required>
                            <option value="0" {{ old('completed', $task->completed) == 0 ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ old('completed', $task->completed) == 1 ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image (Optional)</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($task->image)
                            <img src="{{ asset('storage/' . $task->image) }}" alt="Current Image" class="img-fluid mt-2" style="max-width: 200px;">
                        @endif
                    </div>

                    <!-- Submit and Back Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <!-- Update Task Button with Soft Blue Color -->
                        <button type="submit" class="btn btn-info w-48 rounded-pill p-3">Update Task</button>
                        
                        <!-- Back to Task List Button with the same color as Update Task -->
                        <a href="{{ route('user.tasks') }}" class="btn btn-info w-48 rounded-pill p-3">Back to Task List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and optional Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
