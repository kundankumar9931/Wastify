<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Location - Wastify Law Gate</title>
    <link rel="stylesheet" type="text/css" href="/css/household.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body>
@include ('resident_header')
    <div class="household-container">
    <h1>Register PG / Shop Location</h1>
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('household.store') }}" method="POST" class="household-form">
        @csrf
        <div class="form-group">
        <label for="household_name">PG / Shop / Building Name:</label>
        <input type="text" id="household_name" name="household_name" placeholder="e.g. Sharma PG or Food Street Cafe" required>
        </div>
        <div>
            <label for="location">Location Address:</label>
            <input type="text" id="location" name="location" required>
            <p>Select your exact location on the Law Gate area map below.</p>
            <div id="map"></div>
        </div>
        <button type="submit">Register Location</button>
    </form>
    </div>
    <footer>
    <div class="credit"> &copy; copyright @
      <?php echo date('Y'); ?> Wastify - Law Gate Initiative <br> All Rights Reserved <br>
    </div>
    </footer>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script>
        var map = L.map('map').setView([31.257, 75.698], 16); // Law Gate coordinates

        // Define Law Gate area bounds (Enlarged)
        var bounds = L.latLngBounds(
        L.latLng(31.200, 75.600), // South West
        L.latLng(31.300, 75.800)  // North East
        );

        map.setMaxBounds(bounds);
        map.on('drag', function() {
            map.panInsideBounds(bounds, { animate: false });
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(6);
            var lng = e.latlng.lng.toFixed(6);

            fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng)
                .then(response => response.json())
                .then(data => {
                    var address = data.display_name;
                    document.getElementById('location').value = address;
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);
        });
    </script>
</body>
</html>
