@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('tasks.add_task') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('teacher.tasks.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('tasks.title') }}</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="title_en" class="form-label">{{ __('tasks.title_en') }}</label>
            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('tasks.description') }}</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="study_type" class="form-label">{{ __('tasks.study_type') }}</label>
            <select name="study_type" id="study_type" class="form-control" required>
                <option value="strucni">{{ __('tasks.strucni') }}</option>
                <option value="preddiplomski">{{ __('tasks.preddiplomski') }}</option>
                <option value="diplomski">{{ __('tasks.diplomski') }}</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('tasks.submit') }}</button>
    </form>
</div>
@endsection
