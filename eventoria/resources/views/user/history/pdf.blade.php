<!DOCTYPE html>
<html>
<head>
    <title>Tiket {{ $ticket->id }}</title>
</head>
<body>
    <h1>Tiket Anda</h1>
    <p>Nama: {{ $ticket->name }}</p>
    <p>Email: {{ $ticket->email }}</p>
    <p>Event: {{ $ticket->event_name }}</p>
    <p>Waktu: {{ $ticket->event_date }}</p>
</body>
</html>
