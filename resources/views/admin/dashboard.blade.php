<!DOCTYPE html>
<html>
<head>
    <title>Admin - Foglalások lista</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            
            background: url('img/car-rental.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/admin">Foglalások listája</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/car-edit">Autók szerkesztése</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/car-create">Új autó felvitele</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Foglalások</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Foglalás ID</th>
                <th>Autó neve</th>
                <th>Bérlés kezdete</th>
                <th>Bérlés befejezése</th>
                <th>Felhasználó neve</th>
                <th>Felhasználó telefonszáma</th>
                <th>Felhasználó címe</th>
                <th>Teljes összeg</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->car->name }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->user->telephone_number }}</td>
                    <td>{{ $booking->user->address }}</td>
                    <td>{{ $booking->user->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
