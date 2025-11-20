<form action="{{ route('projekti.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    @if(auth()->id() === $project->user_id)
        <div>
            <label>Naziv projekta</label>
            <input type="text" name="naziv_projekta" value="{{ $project->naziv_projekta }}">
        </div>
        <div>
            <label>Opis projekta</label>
            <textarea name="opis_projekta">{{ $project->opis_projekta }}</textarea>
        </div>
        <div>
            <label>Cijena projekta</label>
            <input type="number" name="cijena_projekta" value="{{ $project->cijena_projekta }}">
        </div>
        <div>
            <label>Datum početka</label>
            <input type="date" name="datum_pocetka" value="{{ $project->datum_pocetka }}">
        </div>
        <div>
            <label>Datum završetka</label>
            <input type="date" name="datum_zavrsetka" value="{{ $project->datum_zavrsetka }}">
        </div>
    @endif

    <div>
        <label>Obavljeni poslovi</label>
        <textarea name="obavljeni_poslovi">{{ $project->obavljeni_poslovi }}</textarea>
    </div>

    <button type="submit">Spremi promjene</button>
</form>
