<!DOCTYPE html>
<html>
<head>
    <title>Admin - új autó létrehozása</title>
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
            <li class="nav-item">
                <a class="nav-link" href="/admin">Foglalások listája</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/car-edit">Autók szerkesztése</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/car-create">Új autó felvitele</a>
            </li>
        </ul>
    </div>
</nav>


<div class="container mt-5">
    <h2>Új autó felvitele</h2>
    <form action="{{ route('car.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="daily_price">Napi Ár:</label>
            <input type="number" name="daily_price" id="daily_price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="img_src">Kép:</label>
            <input type="file" name="img_src" id="img_src" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Felvétel</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
