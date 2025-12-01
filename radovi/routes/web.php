<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Student\TaskController as StudentTaskController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;

Route::get('locale/{locale}', function ($locale) {
    if (! in_array($locale, ['hr', 'en'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return back();
})->name('locale.switch');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('users', [UserRoleController::class, 'index'])->name('admin.users.index');

        // EDIT form
        Route::get('users/{user}/edit', [UserRoleController::class, 'edit'])->name('admin.users.edit');

        // UPDATE role (koristimo PUT)
        Route::put('users/{user}', [UserRoleController::class, 'update'])->name('admin.users.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_student'])->group(function() {
    Route::get('/student/tasks', [StudentTaskController::class, 'index'])->name('student.tasks.index');
    Route::post('/student/tasks/{task}/apply', [StudentTaskController::class, 'apply'])->name('student.tasks.apply');
});

Route::middleware(['auth', 'is_nastavnik'])->group(function() {
    Route::get('/teacher/tasks/create', [TeacherTaskController::class, 'create'])->name('teacher.tasks.create');
    Route::get('/teacher/tasks', [TeacherTaskController::class, 'index'])->name('teacher.tasks.index');
    Route::post('/teacher/tasks', [TeacherTaskController::class, 'store'])->name('teacher.tasks.store');
    Route::get('/teacher/tasks/{task}/applicants', [TeacherTaskController::class, 'applicants'])->name('teacher.tasks.applicants');
    Route::post('/teacher/tasks/{task}/accept/{student}', [TeacherTaskController::class, 'accept'])->name('teacher.tasks.accept');
});



require __DIR__.'/auth.php';
