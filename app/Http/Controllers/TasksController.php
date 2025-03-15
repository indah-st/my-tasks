<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    // Fungsi untuk menampilkan histori task yang telah dihapus
    public function history()
    {
        // Mengambil semua task yang sudah dihapus (soft delete)
        $tasks = Task::onlyTrashed()->get();

        // Mengembalikan view dengan data task yang sudah dihapus
        return view('user.history', compact('tasks'));
    }

    // Menampilkan task history berdasarkan user yang login
    public function showHistory()
    {
        // Ambil data history berdasarkan user yang sedang login
        $histories = TaskHistory::where('user_id', auth()->id())->get();

        // Kirim data ke view
        return view('task-history', compact('histories'));
    }

    // Fungsi untuk memperbarui task
    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        // Menyimpan perubahan pada task
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->completed = $request->input('completed');

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tasks', 'public');
            $task->image = $imagePath;
        }

        // Menyimpan perubahan ke database
        $task->save();

        // Menampilkan pesan sukses
        session()->flash('success', 'Task successfully edited.');

        // Redirect ke halaman tasks setelah berhasil
        return redirect()->route('user.tasks');
    }

    // Fungsi untuk menghapus task secara soft delete
    public function destroy($taskId)
    {
        // Mencari task berdasarkan ID
        $task = Task::findOrFail($taskId);

        // Melakukan soft delete pada task
        $task->delete();

        // Menampilkan pesan sukses setelah task dihapus
        session()->flash('success', 'Task successfully deleted.');

        // Mengarahkan kembali ke halaman daftar tugas
        return redirect()->route('user.tasks');
    }

    // Fungsi untuk menampilkan halaman edit task
    public function edit($id)
    {
        // Mendapatkan ID user yang login dari session
        $userId = session('LoggedUserInfo');

        // Memastikan user telah login
        if (!$userId) {
            return redirect('user/login')->with('fail', 'You must be logged in to access the dashboard');
        }

        // Mencari user berdasarkan ID
        $LoggedUserInfo = User::find($userId);

        // Mencari task berdasarkan ID
        $task = Task::find($id);

        // Jika task tidak ditemukan, redirect dengan pesan error
        if (!$task) {
            return redirect()->route('user.tasks')->with('fail', 'Task not found');
        }

        // Memastikan due_date berupa objek Carbon
        $task->due_date = \Carbon\Carbon::parse($task->due_date);

        // Mengembalikan view dengan data task dan user
        return view('user.edittask', [
            'task' => $task,
            'LoggedUserInfo' => $LoggedUserInfo
        ]);
    }
    

    // Fungsi untuk menampilkan detail task
    public function show($id)
    {
        $userId = session('LoggedUserInfo');

        // Memastikan user telah login
        if (!$userId) {
            return redirect('user/login')->with('fail', 'You must be logged in to access the dashboard');
        }

        // Mencari user berdasarkan ID
        $LoggedUserInfo = User::find($userId);

        // Mencari task berdasarkan ID
        $task = Task::findOrFail($id);

        // Mengembalikan view dengan data task dan user
        return view('user.viewtask', [
            'task' => $task,
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }

    // Fungsi untuk mengembalikan task yang dihapus
    public function restore($taskId)
    {
        // Mengambil task yang sudah dihapus (soft deleted)
        $task = Task::withTrashed()->findOrFail($taskId);

        // Mengembalikan task yang telah dihapus
        $task->restore();

        // Menampilkan pesan sukses dan redirect kembali ke halaman history
        session()->flash('success', 'Task successfully restored.');
        return redirect()->route('user.tasks');
    }

    // Fungsi untuk menghapus permanen task
    public function forceDelete($taskId)
    {
        $task = Task::withTrashed()->findOrFail($taskId);
        $task->forceDelete();

        session()->flash('success', 'Task permanently deleted.');
        return redirect()->route('user.tasks');
    }
}
