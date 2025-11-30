@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Popis radova</h1>

    @if($tasks->count() === 0)
        <p>Nema dostupnih radova.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Naziv rada (HR)</th>
                    <th>Naziv rada (EN)</th>
                    <th>Tip studija</th>
                    <th>Nastavnik</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->title_en }}</td>
                        <td>{{ ucfirst($task->study_type) }}</td>
                        <td>{{ $task->teacher->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tasks->links() }}
    @endif
</div>
@endsection
