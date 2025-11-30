@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Prijavljeni studenti za: {{ $task->title }}</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($applicants->count() === 0)
        <p>Nema prijavljenih studenata.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Ime studenta</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applicants as $student)
                    <tr>
                        <td class="border p-2">{{ $student->name }}</td>
                        <td class="border p-2">{{ $student->email }}</td>
                        <td class="border p-2">
                            @if($student->pivot->accepted)
                                Prihvaćen
                            @else
                                Čeka
                            @endif
                        </td>
                        <td class="border p-2">
                            @if(!$student->pivot->accepted)
                                <form action="{{ route('teacher.tasks.accept', [$task->id, $student->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded">Prihvati</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
