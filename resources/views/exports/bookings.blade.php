<table>
    <thead>
        <tr>
            <th>Room</th>
            <th>Guest</th>
            <th>Book Dates</th>
            <th>Stay</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $b)
            <tr>
                <td>{{ $b->room?->number }} ({{ efmt($b->room?->status) }})</td>
                <td>
                    {{ $b->guest_name }}<br>
                    {{ $b->guest_email }}<br>
                    {{ $b->guest_phone }}
                </td>
                <td>
                    From: {{ dfmt($b->from_date) }}<br>
                    To: {{ dfmt($b->to_date) }}
                </td>
                <td>
                    Check-in: {{ tfmt($b->check_in) }}<br>
                    Check-out: {{ tfmt($b->check_out) }}
                </td>
                <td>{{ efmt($b->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
