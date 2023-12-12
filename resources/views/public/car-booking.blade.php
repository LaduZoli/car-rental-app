<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
        <title>Autó lefoglalása</title>
        
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: auto;
                margin: 0;
                background: url('{{ asset('img/car-rental.jpg') }}') no-repeat center center fixed;
                background-size: cover;
            }
            form {
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 8px;
                width: 400px;
                background-color: rgba(255, 255, 255, 0.9);
                height: auto;
                margin: auto;
                text-align: center;
            }
            label {
                display: block;
                margin-bottom: 8px;
            }
            input {
                width: 100%;
                padding: 8px;
                margin-bottom: 16px;
                box-sizing: border-box;
            }
            button {
                background-color: #4caf50;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                width: 150px;
                display: block; 
                margin: auto;
            }
            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <form id="carBooking">
                @csrf
                <label for="name">Név:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="address">Cím:</label>
                <input type="text" id="address" name="address" required>
                <label for="phone">Telefonszám:</label>
                <input type="tel" id="phone" name="phone" required>
                <label for="days">Foglalandó napok száma:</label>
                <input type="number" id="days" name="days" readonly>
                <label for="amount">Teljes összeg:</label>
                <input type="number" id="amount" name="amount" readonly>
                <button type="submit">Küldés</button>
            </form>
        </div>    

        <script>
        var urlParams = new URLSearchParams(window.location.search);
        var startDateParam = urlParams.get('start_date');
        var endDateParam = urlParams.get('end_date'); 
        var dailyPrice = urlParams.get('daily_price'); 

        var startDate = new Date(startDateParam);
        var endDate = new Date(endDateParam);
        
        var timeDiff = Math.abs(endDate.getTime() - startDate.getTime()) + 1;
        var bookedDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        var totalAmount = dailyPrice * bookedDays; 

        document.getElementById('days').value = bookedDays || 0;
        document.getElementById('amount').value = totalAmount || 0;

        document.getElementById('carBooking').addEventListener('submit', function (event) {
            event.preventDefault();

            var urlParams = new URLSearchParams(window.location.search);
            var currentUrl = window.location.href;
            var startDateParam = urlParams.get('start_date');
            var endDateParam = urlParams.get('end_date');
            var carId = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

            if (carId.includes('?')) {
                carId = carId.substring(0, carId.indexOf('?'));
            }

            var startDate = new Date(startDateParam);
            var endDate = new Date(endDateParam);

            var formData = new FormData(this);
            formData.set('start_date', startDateParam);
            formData.set('end_date', endDateParam);
            formData.set('car_id', carId);

            fetch('{{ route('car.booking.submit') }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert('Sikeres foglalás');

                window.location.href = "{{ route('home') }}";
            })
            .catch(error => {
                console.error('Hiba történt:', error);
            });
        });
        </script>
    </body>
</html>