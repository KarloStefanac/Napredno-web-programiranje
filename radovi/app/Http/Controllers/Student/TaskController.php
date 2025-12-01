<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        // Student vidi sve radove na koje se još može prijaviti
        $tasks = Task::whereDoesntHave('applicants', function($q) {
            $q->where('user_id', auth()->id());
        })->get();

        return view('student.tasks.index', compact('tasks'));
    }

    public function apply(Task $task)
    {
        $userId = auth()->id();

        if ($task->applicants()->where('student_id', $userId)->exists()) {
            return redirect()->route('student.tasks.index')->with('error', 'Greska pri prijavi.');
            // return back()->with('error', __('student.tasks.index'));
        }

        $task->applicants()->attach($userId);
        return redirect()->route('student.tasks.index')->with('success', 'Prijavljen na task.');
        // return back()->with('success', __('student.tasks.index'));
    }

}
