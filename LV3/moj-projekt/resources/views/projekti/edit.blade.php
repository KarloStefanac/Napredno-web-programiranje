@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Uredi projekt: {{ $project->naziv_projekta }}</h1>

    <form action="{{ route('projekti.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

        @if(auth()->id() === $project->user_id)
            <div>
                <label>Naziv projekta</label>
                <input type="text" name="naziv_projekta" value="{{ old('naziv_projekta', $project->naziv_projekta) }}">
            </div>

            <div>
                <label>Opis projekta</label>
                <textarea name="opis_projekta">{{ old('opis_projekta', $project->opis_projekta) }}</textarea>
            </div>

            <div>
                <label>Cijena projekta</label>
                <input type="number" name="cijena_projekta" value="{{ old('cijena_projekta', $project->cijena_projekta) }}">
            </div>

            <div>
                <label>Datum početka</label>
                <input type="date" name="datum_pocetka" value="{{ old('datum_pocetka', $project->datum_pocetka) }}">
            </div>

            <div>
                <label>Datum završetka</label>
                <input type="date" name="datum_zavrsetka" value="{{ old('datum_zavrsetka', $project->datum_zavrsetka) }}">
            </div>

            <div>
                <label>Članovi tima</label>
                <select name="members[]" multiple>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $project->members->contains($user) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div>
            <label>Obavljeni poslovi</label>
            <textarea name="obavljeni_poslovi">{{ old('obavljeni_poslovi', $project->obavljeni_poslovi) }}</textarea>
        </div>

        <button type="submit">Spremi promjene</button>
    </form>
</div>
@endsection
