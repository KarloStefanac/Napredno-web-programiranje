<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        // Dohvati sve radove
        $tasks = Task::with('teacher')->orderBy('created_at', 'desc')->paginate(20);

        return view('student.tasks.index', compact('tasks'));
    }

    public function apply(Task $task)
    {
        $user = auth()->user();

        if ($task->applicants()->where('student_id', $user->id)->exists()) {
            return back()->with('error', 'Već ste prijavljeni na ovaj rad.');
        }

        $task->applicants()->attach($user->id);

        return back()->with('success', 'Uspješno ste se prijavili na rad.');
    }

}
