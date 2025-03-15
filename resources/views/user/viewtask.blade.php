<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #FF80AB;">
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

        <!-- Task Details Card -->
        <div class="card shadow-lg rounded-4" style="background-color: #fff4e6;">
            <div class="card-body">
                <h5 class="card-title text-primary">{{ $task->title }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
                
                <p class="card-text"><strong>Due Date:</strong> <span id="dueDate">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span></p>

                <p class="card-text"><strong>Status:</strong> {{ $task->completed ? 'Completed' : 'Pending' }}</p>

                <!-- Waktu sisa countdown -->
                <p id="countdown" class="card-text text-danger"></p>
                <p id="completionMessage" class="card-text text-success" style="display: none;">Thank you for completing the task!</p>

                <!-- Image Preview -->
                @if ($task->image)
                    <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" class="img-fluid rounded mb-3 shadow-sm" style="max-width: 300px;">
                @endif

                <!-- Back to Tasks Button with soft green color -->
                <a href="{{ route('user.tasks') }}" class="btn btn-success mt-3 px-4 py-2 rounded-pill shadow-sm" style="background-color:rgb(89, 192, 154); border-color: #a8e6cf;">Back to Tasks</a>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and optional Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Countdown Timer Script -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const countdownElement = document.getElementById('countdown');
        const dueDateElement = document.getElementById('dueDate');
        const completionMessageElement = document.getElementById('completionMessage');
        const dueDateString = dueDateElement.innerText;  // Ambil teks tanggal dan waktu due
        const dueDate = new Date(dueDateString);  // Konversi ke format Date
        const now = new Date();  // Ambil waktu saat ini

        // Periksa apakah tugas sudah selesai
        const isTaskCompleted = {{ $task->completed ? 'true' : 'false' }};

        // Flag untuk task berdasarkan ID, menggunakan localStorage
        const taskId = 'task_' + {{ $task->id }}; // Menggunakan ID task dari backend

        function updateCountdown() {
            const currentTime = new Date();
            const timeRemaining = dueDate - currentTime; // Waktu tersisa dalam milidetik

            if (isTaskCompleted) {
                // Jika tugas sudah selesai
                countdownElement.style.display = 'none'; // Sembunyikan countdown
                completionMessageElement.style.display = 'block'; // Tampilkan pesan terima kasih
                return;
            }

            if (timeRemaining > 0) {
                // Hitung hari, jam, menit, detik
                const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                // Update tampilan countdown
                countdownElement.innerHTML = `Time left: ${days}d ${hours}h ${minutes}m ${seconds}s`;

            } else {
                // Jika waktu sudah habis
                countdownElement.innerHTML = `Task Deadline Passed! Please complete the task.`;
                countdownElement.classList.add('alert', 'alert-danger'); // Menambahkan kelas alert
            }
        }

        // Update countdown setiap detik
        setInterval(updateCountdown, 1000);

        // Jalankan fungsi pertama kali saat halaman dimuat
        updateCountdown();

        function checkH1Notification() {
            const oneDayInMilliseconds = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
            const timeRemaining = dueDate - now;

            // Cek apakah sudah ada flag di localStorage yang menandakan notifikasi sudah ditampilkan dan ditutup
            if (localStorage.getItem(taskId + '_notified') === 'true') {
                return; // Jika sudah, tidak perlu tampilkan notifikasi lagi dalam sesi ini
            }

            // Jika waktu tersisa 24 jam (H-1)
            if (timeRemaining <= oneDayInMilliseconds && timeRemaining > 0) {
                // Tampilkan notifikasi dan set flag agar tidak muncul lagi dalam sesi ini
                const userConfirmed = confirm('Reminder: Your task is due in 1 day!');

                if (userConfirmed) {
                    // Jika user klik OK, simpan status bahwa notifikasi sudah ditampilkan
                    localStorage.setItem(taskId + '_notified', 'true');
                }
            }
        }

        // Run checkH1Notification once when the page loads
        checkH1Notification();

        // Tambahkan event listener untuk reset status notification ketika Anda melihat task lagi
        window.addEventListener('focus', function() {
            // Reset status 'notified' jika halaman task yang sama di-fokuskan kembali
            localStorage.removeItem(taskId + '_notified');
            checkH1Notification();
        });
    });
</script>

    </script>

</body>
</html>
