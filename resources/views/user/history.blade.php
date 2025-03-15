<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task History</title>
    <!-- Link to Bootstrap CSS for Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Google Fonts for Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Fredoka+One&display=swap" rel="stylesheet">
</head>
<body class="bg-light">


    <!-- Second Section: Deleted Tasks History -->
    <div class="container mt-5">
        
        <!-- Tambahkan di bagian atas halaman user.history -->
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

<!-- Konten lainnya seperti tabel history -->

        <h1 class="text-center mb-4" style="font-family: 'Fredoka One', cursive; color: #ff6f91;">Deleted Tasks History</h1>

        <!-- Check if there are any deleted tasks -->
        @if ($tasks->isEmpty())
            <div class="alert alert-warning text-center">
                <strong>No deleted tasks found.</strong>
            </div>
        @else
            <!-- Table for displaying deleted tasks -->
            <div class="card p-4 shadow-sm" style="background-color: #fff4f4; border-radius: 15px;">
                <table class="table table-bordered table-striped">
                    <thead class="text-white" style="background-color: #ff91a4;">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td style="font-family: 'Fredoka One', cursive; color: #ff6f91;">{{ $task->title }}</td>
                                <td style="color: #6c757d;">{{ $task->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" style="background-color: #86efac; border: none;">Restore</button>
                                    </form>

                                    <!-- Permanent Delete Button -->
                                    <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="background-color: #ff6f91; border: none;">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
