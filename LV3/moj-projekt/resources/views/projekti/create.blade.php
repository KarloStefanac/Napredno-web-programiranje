@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novi projekt</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('projekti.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="naziv_projekta" class="form-label">Naziv projekta</label>
            <input type="text" class="form-control" name="naziv_projekta" id="naziv_projekta" required>
        </div>

        <div class="mb-3">
            <label for="opis_projekta" class="form-label">Opis projekta</label>
            <textarea class="form-control" name="opis_projekta" id="opis_projekta"></textarea>
        </div>

        <div class="mb-3">
            <label for="cijena_projekta" class="form-label">Cijena projekta</label>
            <input type="number" step="0.01" class="form-control" name="cijena_projekta" id="cijena_projekta">
        </div>

        <div class="mb-3">
            <label for="obavljeni_poslovi" class="form-label">Obavljeni poslovi</label>
            <textarea class="form-control" name="obavljeni_poslovi" id="obavljeni_poslovi"></textarea>
        </div>

        <div class="mb-3">
            <label for="datum_pocetka" class="form-label">Datum početka</label>
            <input type="date" class="form-control" name="datum_pocetka" id="datum_pocetka">
        </div>

        <div class="mb-3">
            <label for="datum_zavrsetka" class="form-label">Datum završetka</label>
            <input type="date" class="form-control" name="datum_zavrsetka" id="datum_zavrsetka">
        </div>

        <div class="mb-3">
            <label for="members" class="form-label">Članovi tima</label>
            <select name="members[]" id="members" class="form-control" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Kreiraj projekt</button>
    </form>
</div>
@endsection
