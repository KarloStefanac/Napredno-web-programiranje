@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profil korisnika: {{ $user->name }}</h1>

    <h2>Projekti gdje sam voditelj</h2>
    @if($projektiVoditelj->count())
        <ul>
            @foreach($projektiVoditelj as $projekt)
                <li>{{ $projekt->naziv_projekta }} ({{ $projekt->datum_pocetka }} - {{ $projekt->datum_zavrsetka }})</li>
            @endforeach
        </ul>
    @else
        <p>Trenutno nema projekata koje vodiš.</p>
    @endif

    <h2>Projekti gdje sam član tima</h2>
    @if($projektiClan->count())
        <ul>
            @foreach($projektiClan as $projekt)
                <li>{{ $projekt->naziv_projekta }} (voditelj: {{ $projekt->voditelj->name }})</li>
            @endforeach
        </ul>
    @else
        <p>Trenutno nisi član nijednog projekta.</p>
    @endif
</div>
@endsection
