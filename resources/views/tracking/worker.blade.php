@extends('layouts.worker')

@section('head')
    <!-- Additional Leaflet routing styles if needed -->
    <style>
        .leaflet-routing-container {
            display: none !important;
        }
    </style>
@endsection

@section('content')
<div class="container" style="padding: 20px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="margin: 0; color: #2c3e50;">Active Route Map</h1>
        <p style="color: #7f8c8d; margin: 0; font-weight: 500;">Live Tracking</p>
    </div>

    <div class="card" style="background: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px;">
        <div id="map" style="height: 600px; width: 100%; border-radius: 8px; z-index: 1;"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize map
        var map = L.map('map').setView([31.257, 75.698], 15);

        // Use CartoDB Voyager map to avoid the "corrupt"/grey building aesthetic of standard OSM
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);

        // Waste Disposal Site marker
        var wasteDisposalSite = L.marker([31.257, 75.698]).addTo(map)
            .bindPopup('<b>Law Gate Disposal Center</b><br>Drop-off point')
            .openPopup();

        // Simulate some dummy trucks for visual testing
        var trucks = [
            {id: 1, lat: 31.258, lon: 75.699},
            {id: 2, lat: 31.256, lon: 75.697}
        ];
        
        var truckMarkers = {};

        trucks.forEach(function(truck) {
            var marker = L.marker([truck.lat, truck.lon], {
                icon: L.icon({
                    iconUrl: '/Images/truck-icon.png', // Ensure the correct PNG extension
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                })
            }).addTo(map).bindPopup('<b>Waste Truck ' + truck.id + '</b><br>Active Route');

            truckMarkers[truck.id] = marker;
        });

        // Trigger resize event after layout settles so map tiles load correctly
        setTimeout(function() {
            map.invalidateSize();
        }, 300);
    });
</script>
@endsection
