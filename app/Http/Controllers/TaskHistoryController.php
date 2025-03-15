<?php

namespace App\Http\Controllers;

use App\Models\TaskHistory;
use Illuminate\Http\Request;

class TaskHistoryController extends Controller
{
    // Menampilkan task history berdasarkan user yang sedang login
    public function index()
    {
        $userId = auth()->id();  // Mendapatkan ID user yang sedang login

        // Ambil history untuk user yang sedang login
        $histories = TaskHistory::where('user_id', $userId)->get();

        // Kirim data ke view
        return view('tasks.history', compact('histories'));
    }
    
        // Method untuk menampilkan halaman history
        public function showHistory() {
            // Pastikan user sudah login
            if (!isset($_SESSION['user_id'])) {
                // Redirect ke halaman login jika tidak ada session user_id
                header("Location: login.php");
                exit();
            }
    
            // Ambil user_id dari session
            $user_id = $_SESSION['user_id'];
    
            // Ambil data history untuk user ini
            $historyData = $this->getUserHistory($user_id);
            
            // Tampilkan halaman history dan kirim data history ke view
            include 'views/history_view.php';
        }
    
        // Fungsi untuk mengambil data history dari database
        private function getUserHistory($user_id) {
            // Koneksi ke database
            $conn = new mysqli("localhost", "username", "password", "database_name");
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            // Query untuk mengambil history berdasarkan user_id
            $query = "SELECT * FROM history WHERE user_id = ? ORDER BY timestamp DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Ambil data history dalam bentuk array
            $historyData = [];
            while ($row = $result->fetch_assoc()) {
                $historyData[] = $row;
            }
    
            // Tutup koneksi database
            $conn->close();
    
            return $historyData;
        }
    }

