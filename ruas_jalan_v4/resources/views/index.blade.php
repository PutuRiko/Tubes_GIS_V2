<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Bootstrap CSS (optional, for styling buttons) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #map {
            height: 400px; /* Set the height for the map */
            width: 100%; /* Set the width for the map */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to Ruas Jalan</h1>
        <div id="map"></div>
        <div class="mt-3">
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([-8.409518, 115.188919], 10);

        // Add the OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker
        var marker = L.marker([-8.409518, 115.188919], 10).addTo(map)
            .bindPopup('Ini di Bali')
            .openPopup();
    </script>
    <!-- Bootstrap JS (optional, for Bootstrap functionalities) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
