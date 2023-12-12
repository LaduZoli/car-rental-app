<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autók Szerkesztése</title>
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
        img {
            width: 100px;
            display: block;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="/admin">Foglalások listája</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/car-edit">Autók szerkesztése</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/car-create">Új autó felvitele</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Autók Szerkesztése</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Napi ár</th>
                <th>Kép</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->daily_price }}</td>
                    <td><img src="img/{{ $car->img_src }}"></td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary">Szerkesztés</a>
                    </td>
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
