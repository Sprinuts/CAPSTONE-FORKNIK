<div>
    <h2>Psychometrician's Schedules</h2>
    @if($schedules->isEmpty())
        <p>No schedules found.</p>
    @else
        <ul>
            @foreach($schedules as $schedule)
                <li>
                    Date: {{ $schedule->date }} <br>
                    Time: {{ $schedule->start_time }} <br>
                    Client: {{ $schedule->client_name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
