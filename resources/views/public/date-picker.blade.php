<!DOCTYPE html>
<html>
<head>
    <title>Autókölcsönző - Dátum kiválasztása</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
            margin: 0;
            background: url('img/car-rental.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 400px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid;
        }

        .container h2 {
            text-align: center;
            padding-bottom: 20px; 
        }

        .search-button {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <form action="{{ route('available.cars') }}" method="get">
        @csrf
        
        <h2 class="mb-4">Autókölcsönző <br> Dátum kiválasztása</h2>
        
        <div class="form-group">
            <label for="start_date">Felvétel dátuma:</label>
            <div class='input-group date' id='pickup_date'>
                <input type='date' class="form-control" id="start_date" name="start_date" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        
        <div class="form-group">
            <label for="return_date">Leadás dátuma:</label>
            <div class='input-group date' id='return_date'>
                <input type='date' class="form-control" id="end_date" name="end_date" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary search-button">Keresés</button>
    </form>    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(document).ready(function () {
        $('#pickup_date, #return_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });
</script>

</body>
</html>
