@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-black p-6 rounded shadow mt-6">
    <h1 class="text-2xl font-bold mb-4 text-white">{{ __('tasks.my_tasks') }}</h1>

    <a href="{{ route('teacher.tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        {{ __('tasks.add_new') }}
    </a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">{{ __('tasks.title_hr') }}</th>
                <th class="p-2">{{ __('tasks.title_en') }}</th>
                <th class="p-2">{{ __('tasks.study_type') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="text-white">
                <td class="border p-2">{{ $task->title }}</td>
                <td class="border p-2">{{ $task->title_en }}</td>
                <td class="border p-2">{{ __( 'tasks.' . $task->study_type ) }}</td>
                <td class="border p-2 space-x-2">
                    <a href="{{ route('teacher.tasks.applicants', $task) }}" class="bg-indigo-600 text-white px-2 py-1 rounded">Prijave</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
