<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Tracking - Wastify Law Gate</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/tracking.css">
</head>
<body>
@include ('resident_header')

    <div class="container">
        <h1>Track Law Gate Trucks</h1>
        <div id="map" style="height: 500px; width: 100%; max-width: 1000px; margin: 0 auto;"></div>
    </div>
    <footer>
        <div class="credit"> &copy; copyright @
        <?php echo date('Y'); ?> Wastify - Law Gate Initiative <br> All Rights Reserved <br>
        </div>
    </footer>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script>
        // Initialize the map and set its view to Law Gate Market area
        var map = L.map('map').setView([31.257, 75.698], 16);

        // Add a tile layer to the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Define the waste disposal site location in Law Gate
        var wasteDisposalSite = L.marker([31.257, 75.698]).addTo(map)
            .bindPopup('Law Gate Disposal Center')
            .openPopup();

        // Check if the browser supports geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;

                var userMarker = L.marker([lat, lon]).addTo(map)
                    .bindPopup('Your Location')
                    .openPopup();

                map.setView([lat, lon], 16);

                L.Routing.control({
                    waypoints: [
                        L.latLng(31.257, 75.698),
                        L.latLng(lat, lon)
                    ],
                    routeWhileDragging: true,
                    createMarker: function() { return null; },
                    lineOptions: {
                        styles: [{color: '#2e7d32', opacity: 1, weight: 4}]
                    },
                    addWaypoints: false,
                    draggableWaypoints: false,
                    fitSelectedRoutes: true,
                    showAlternatives: false,
                    show: false
                }).addTo(map);

                // Simulate truck locations around Law Gate
                var trucks = [
                    {id: 1, lat: 31.258, lon: 75.699},
                    {id: 2, lat: 31.256, lon: 75.697},
                    {id: 3, lat: (lat + 31.257) / 2, lon: (lon + 75.698) / 2}
                ];

                var truckMarkers = {};

                trucks.forEach(function(truck) {
                    var marker = L.marker([truck.lat, truck.lon], {
                        icon: L.icon({
                            iconUrl: '/images/truck-icon.jpg',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32]
                        })
                    }).addTo(map).bindPopup('Waste Truck ' + truck.id);

                    truckMarkers[truck.id] = marker;
                });

                // Simulate truck movement
                setInterval(function() {
                    trucks.forEach(function(truck) {
                        var newLat = truck.lat + (Math.random() - 0.5) * 0.0005;
                        var newLon = truck.lon + (Math.random() - 0.5) * 0.0005;
                        truck.lat = newLat;
                        truck.lon = newLon;

                        truckMarkers[truck.id].setLatLng([newLat, newLon]);
                    });
                }, 3000);

            }, function(error) {
                console.error('Geolocation error:', error);
            });
        }
    </script>
</body>
</html>
