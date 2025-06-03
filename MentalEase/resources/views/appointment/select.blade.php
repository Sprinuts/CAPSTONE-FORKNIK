<h2>Select Psychometrician</h2>
<ul>
    @foreach($psychometricians as $psy)
        <li>
            {{ $psy->name }}
            <a href="{{ route('appointment.choose', $psy->id) }}">Choose </a>
            <h1>palagyan navbar</h1>
        </li>
    @endforeach
</ul>