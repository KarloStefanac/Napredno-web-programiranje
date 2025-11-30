<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function applicants(Task $task)
    {
        $this->authorize('view', $task); // provjeri da nastavnik ima pravo na taj rad

        $applicants = $task->applicants()->get();

        return view('teacher.tasks.applicants', compact('task', 'applicants'));
    }

    public function accept(Task $task, User $student)
    {
        $this->authorize('view', $task);

        // prihvati studenta
        $task->applicants()->updateExistingPivot($student->id, ['accepted' => true]);

        return back()->with('success', $student->name . ' je prihvaćen.');
    }

}
