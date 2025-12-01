@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white">Uredi ulogu: {{ $user->name }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="role" class="form-label text-white">Uloga</label>
            <select name="role" id="role" class="form-control">
                @foreach($roles as $key => $label)
                    <option value="{{ $key }}" @if($user->role === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success text-white">Spremi</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary text-white">Natrag</a>
    </form>
</div>
@endsection
