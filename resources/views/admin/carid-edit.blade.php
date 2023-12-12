<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autó Szerkesztése</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            
            background: url('{{ asset('img/car-rental.jpg') }}') no-repeat center center fixed;
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
            width: 400px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Autó Szerkesztése</h2>
    <form action="{{ route('car.update', $car->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name" value="{{ $car->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="daily_price">Napi Ár:</label>
            <input type="number" name="daily_price" id="daily_price" value="{{ $car->daily_price }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Elérhető:</label>
            <input type="checkbox" name="status" id="status" value="1"{{ $car->status ? 'checked' : '' }}>
        </div>

        <div class="form-group">
            <label for="img_src">Kép:</label>
            <img src="{{ asset('img/' . $car->img_src) }}" alt="{{ $car->name }}">
            <input type="file" name="img_src" id="img_src" class="form-control-file">
        </div>


        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
