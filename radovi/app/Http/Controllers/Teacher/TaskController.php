<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('teacher.tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('teacher.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description' => 'required|string',
            'study_type' => 'required|in:strucni,preddiplomski,diplomski',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'title_en' => $request->title_en,
            'description' => $request->description,
            'study_type' => $request->study_type,
        ]);

        return redirect()->route('teacher.tasks.create')
            ->with('success', __('tasks.submit') . ' successful!');
    }

    public function applicants(Task $task)
    {
        $this->authorizeOwnership($task);
        $applicants = $task->applicants()->withPivot('accepted')->get();
        return view('teacher.tasks.applicants', compact('task','applicants'));
    }

    public function accept(Task $task, User $student)
    {
        $this->authorizeOwnership($task);

        // opcionalno: onemogući prihvaćanje ako već postoji prihvaćen student
        $alreadyAccepted = $task->applicants()->wherePivot('accepted', true)->exists();
        if ($alreadyAccepted) {
            return redirect()->route('teacher.tasks.applicants', $task)
                 ->with('error', 'Greska pri prihvacanju studenta');

            // return back()->with('error', __('tasks.already_has_accepted'));
        }

        $task->applicants()->updateExistingPivot($student->id, ['accepted' => true]);

        return redirect()->route('teacher.tasks.applicants', $task)
                 ->with('success', 'Student prihvacen');

        // return back()->with('success', $student->name . ' ' . __('tasks.was_accepted'));
    }

    protected function authorizeOwnership(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Nemate pravo pristupa ovom radu.');
        }
    }

}
