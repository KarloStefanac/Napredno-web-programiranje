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
}
