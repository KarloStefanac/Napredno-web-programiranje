@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-black p-6 rounded shadow mt-6">
    <h1 class="text-2xl font-bold mb-4">{{ __('tasks.available') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-success">{{ session('error') }}</div>
    @endif

    <table class="w-full border">
        <thead>
        <tr class="bg-gray-100">
            <th class="p-2">{{ __('tasks.title_hr') }}</th>
            <th class="p-2">{{ __('tasks.title_en') }}</th>
            <th class="p-2">{{ __('tasks.study_type') }}</th>
            <th class="p-2"></th>
        </tr>
        </thead>

        <tbody>
        @foreach($tasks as $task)
            <tr class="text-white">
                <td class="border p-2">{{ $task->title }}</td>
                <td class="border p-2">{{ $task->title_en }}</td>
                <td class="border p-2">{{ __('tasks.' . $task->study_type) }}</td>
                <td class="border p-2">
                    <form method="POST" action="{{ route('student.tasks.apply', $task) }}">
                        @csrf
                        <button class="bg-green-600 text-white px-3 py-1 rounded">
                            {{ __('tasks.apply') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
