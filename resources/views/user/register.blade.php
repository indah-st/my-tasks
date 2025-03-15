<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-6 p-5 bg-white rounded-4 shadow-lg">
            <h2 class="text-center text-primary mb-4 fw-bold" style="color: #6f42c1;">Register</h2>

            <!-- Display any validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.save') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-info fw-bold">Name</label>
                    <input type="text" class="form-control form-control-lg shadow-none" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-info fw-bold">Email</label>
                    <input type="email" class="form-control form-control-lg shadow-none" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label text-info fw-bold">Password</label>
                    <input type="password" class="form-control form-control-lg shadow-none" id="password" name="password" required>
                    <span id="password-toggle" class="position-absolute top-50 end-0 me-3 translate-middle-y" style="cursor: pointer;" onclick="togglePassword()">👁️</span>
                </div>

                <button type="submit" class="btn btn-lg w-100 py-3" style="background-color: #ff007f; color: white;">Register</button>

                <!-- Login link -->
                <div class="text-center mt-3">
                    <p class="mb-0">Already have an account? <a href="{{ route('user.login') }}" class="text-decoration-none" style="color: #6f42c1;">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to toggle password visibility
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var passwordToggle = document.getElementById('password-toggle');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.innerHTML = '🙈';  // Change icon to "hide" icon
            } else {
                passwordField.type = 'password';
                passwordToggle.innerHTML = '👁️';  // Change icon to "show" icon
            }
        }
    </script>
</body>
</html>
