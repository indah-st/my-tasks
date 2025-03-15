<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Google Fonts for custom playful fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Lobster&display=swap" rel="stylesheet">
</head>
<body class="bg-light">

<div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #FF80AB;">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 fw-bold" href="#" style="font-family: 'Pacifico', cursive;">My Tasks</a> <!-- Add a playful font here -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fs-5" href="#" style="font-family: 'Pacifico', cursive;">Welcome, {{ $LoggedUserInfo->name }}</a> <!-- Apply playful font -->
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link" style="border:none; background:none; font-family: 'Pacifico', cursive;">Logout</button> <!-- Add playful font here -->
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-5">
        <!-- Card for Add Task Section -->
        <div class="card bg-light mb-4">
            <div class="card-header text-center" style="background-color: #b3e5fc;">
                <h2 class="text-white" style="font-family: 'Pacifico', cursive;">Add New Task</h2> <!-- Apply playful font to card header -->
            </div>
            <div class="card-body">
                <livewire:add-task />
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and optional Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
