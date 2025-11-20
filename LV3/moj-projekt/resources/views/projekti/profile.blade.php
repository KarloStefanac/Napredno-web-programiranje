<h2>Projekti gdje sam voditelj</h2>

<ul>
@foreach($projektiVoditelj as $projekt)
    <li>{{ $projekt->naziv_projekta }}</li>
@endforeach
</ul>


<h2>Projekti gdje sam član tima</h2>

<ul>
@foreach($projektiClan as $projekt)
    <li>{{ $projekt->naziv_projekta }}</li>
@endforeach
</ul>
