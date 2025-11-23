@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Moji projekti</h1>

    <!-- Zeleni gumb: Kreiraj novi projekt -->
    <a href="{{ route('projekti.create') }}" class="btn btn-success mb-3">Novi projekt</a>

    <h2>Projekti gdje sam voditelj</h2>
    @if($projektiVoditelj->count())
        <ul>
            @foreach($projektiVoditelj as $projekt)
                <li>
                    {{ $projekt->naziv_projekta }}

                    <!-- Plavi gumb: Uredi -->
                    <a href="{{ route('projekti.edit', $projekt) }}" class="btn btn-primary btn-sm">Uredi</a>

                    <!-- Crveni gumb: Obriši -->
                    <form action="{{ route('projekti.destroy', $projekt) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Jeste li sigurni?')">
                            Obriši
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Trenutno nema projekata koje vodiš.</p>
    @endif

    <h2>Projekti gdje sam član tima</h2>
    @if($projektiClan->count())
        <ul>
            @foreach($projektiClan as $projekt)
                <li>
                    {{ $projekt->naziv_projekta }} (voditelj: {{ $projekt->voditelj->name }})

                    <!-- Plavi gumb: ažuriranje obavljenih poslova -->
                    <a href="{{ route('projekti.edit', $projekt) }}" class="btn btn-primary btn-sm">
                        Ažuriraj obavljene poslove
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Trenutno nisi član nijednog projekta.</p>
    @endif
</div>
@endsection
