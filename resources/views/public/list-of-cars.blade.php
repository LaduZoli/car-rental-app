<!DOCTYPE html>
<html>
<head>
    <title>Autókölcsönző - Autók listája</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <style>
        body {
            background: url('img/car-rental.jpg') no-repeat center center fixed;
            background-size: cover;
            padding-top: 20px;            
        }

        .container {
            max-width: 1200px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid;
        }

        .container h2 {
            text-align: center;
            padding-bottom: 20px; 
            font-family: "Times New Roman", Times, serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 100px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #car-img {
            cursor: pointer;
            
        }

        #zoomedImage {
            width: 100%;
            height: 100vh; 
            display: block;
        }

        .modal {
            display: none; 
            position: fixed; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1; 
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            display: block;
            max-width: 100%;
            max-height: 100%;
        }

    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Autókölcsönző - Autók listája</h2>

    @if ($availableCars->isEmpty())
        <p>Nincs elérhető autó az adott időpontokban.</p>
    @else
        <table>
            <tr>
              <th>Autó neve</th>
              <th>Kép</th>
              <th>Napi ára</th>
              <th></th>
            </tr>
            @foreach ($availableCars as $car)
            <tr>
                <td>{{ $car->name }}</td>
                <td>
                    <img src='img/{{ $car->img_src }}' onclick="openModal('{{ $car->img_src }}')">
                </td>
                <td>{{ $car->daily_price }} ft</td>
                <td>
                    <button type="button" class="btn btn-primary search-button" onclick="showForm('{{ $car->id }}', '{{ $car->daily_price }}')">Lefoglalom</button>
                </td>
            </tr>
            @endforeach
        </table>
    @endif    
     
        
    <div id="myModal" class="modal" onclick="closeModal()">
        <img alt="Zoomed Image" id="zoomedImage" class="modal-content">
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>
    function openModal(imgSrc) {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        var zoomedImage = document.getElementById('zoomedImage');
        zoomedImage.src = '{{ asset("img") }}/' + imgSrc;
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    function showForm(carId, dailyPrice) {
        var urlParams = new URLSearchParams(window.location.search);
        var startDateParam = urlParams.get('start_date');
        var endDateParam = urlParams.get('end_date'); 

        var bookingUrl = "{{ route('car.booking', ':carId') }}".replace(':carId', carId);

        bookingUrl += '?start_date=' + startDateParam + '&end_date=' + endDateParam + '&daily_price=' + dailyPrice;
    
        window.location.href = bookingUrl;
        }

</script>

</body>
</html>
