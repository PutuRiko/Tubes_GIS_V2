<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Geografis</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('images/3d-map.png') }}" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles_index.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-editable@1.2.0/src/Leaflet.Editable.css" />
    <style>
        #mapid {
            height: 700px;
        }
    </style>
</head>
<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('layout') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('images/3d-map.png') }}" alt="">
                <span class="d-none d-lg-block">Sistem Informasi Geografis</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('images/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Putu Riko</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>User</h6>
                            <span>2105551118</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('layout') }}">
                    <i class="bi bi-gear"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <button id="get-ruas-jalan" class="btn btn-success nav-link">
                    <i class="bi bi-geo-alt"></i>
                    <span>GET RUAS JALAN</span>
                </button>
            </li>
            <li class="nav-item">
                <h5>Tambah Data Ruas Jalan</h5>
                <form id="ruasjalan-form">
                    <div class="mb-3">
                        <label for="paths" class="form-label">Paths</label>
                        <input type="text" class="form-control" id="paths" name="paths" placeholder="Masukkan Paths">
                    </div>
                    <div class="mb-3">
                        <label for="desa_id" class="form-label">Desa ID</label>
                        <input type="text" class="form-control" id="desa_id" name="desa_id" placeholder="Masukkan Desa ID">
                    </div>
                    <div class="mb-3">
                        <label for="kode_ruas" class="form-label">Kode Ruas</label>
                        <input type="text" class="form-control" id="kode_ruas" name="kode_ruas" placeholder="Masukkan Kode Ruas">
                    </div>
                    <div class="mb-3">
                        <label for="nama_ruas" class="form-label">Nama Ruas</label>
                        <input type="text" class="form-control" id="nama_ruas" name="nama_ruas" placeholder="Masukkan Nama Ruas">
                    </div>
                    <div class="mb-3">
                        <label for="panjang" class="form-label">Panjang</label>
                        <input type="text" class="form-control" id="panjang" name="panjang" placeholder="Masukkan Panjang">
                    </div>
                    <div class="mb-3">
                        <label for="lebar" class="form-label">Lebar</label>
                        <input type="text" class="form-control" id="lebar" name="lebar" placeholder="Masukkan Lebar">
                    </div>
                    <div class="mb-3">
                        <label for="eksisting_id" class="form-label">Eksisting ID</label>
                        <input type="text" class="form-control" id="eksisting_id" name="eksisting_id" placeholder="Masukkan Eksisting ID">
                    </div>
                    <div class="mb-3">
                        <label for="kondisi_id" class="form-label">Kondisi ID</label>
                        <input type="text" class="form-control" id="kondisi_id" name="kondisi_id" placeholder="Masukkan Kondisi ID">
                    </div>
                    <div class="mb-3">
                        <label for="jenisjalan_id" class="form-label">Jenis Jalan ID</label>
                        <input type="text" class="form-control" id="jenisjalan_id" name="jenisjalan_id" placeholder="Masukkan Jenis Jalan ID">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="submitRuasJalan">Submit</button>
                </form>
            </li>
        </ul>
    </aside>
    <main>
        <div id="mapid"></div>
        <div id="ruasJalanList"></div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-encoded-polyline/1.0.0/leaflet.polyline.encoded.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/polyline-encoded@0.0.9/Polyline.encoded.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-editable@1.2.0/src/Leaflet.Editable.js"></script>
    <script>
        var mymap = L.map('mapid', { zoomControl: false, editable: true }).setView([-8.409518, 115.188919], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(mymap);

        var polyline = null;
        var polylinePoints = [];
        var markers = [];

        mymap.on('click', function(event) {
            var latlng = event.latlng;
            var marker = L.marker(latlng, {
                icon: L.icon({
                    iconUrl: "{{ asset('images/3d-map.png') }}",
                    iconSize: [38, 38],
                    iconAnchor: [19, 38],
                    popupAnchor: [0, -38]
                }),
                draggable: true  // Make the marker draggable
            }).addTo(mymap);

            markers.push(marker);

            if (!polyline) {
                polyline = mymap.editTools.startPolyline();
            }
            polyline.addLatLng(latlng);

            marker.bindPopup("Latitude: " + latlng.lat.toFixed(5) + "<br>Longitude: " + latlng.lng.toFixed(5)).openPopup();
            
            marker.on('drag', function(event) {
                var marker = event.target;
                var position = marker.getLatLng();
                var index = markers.indexOf(marker);

                polyline.editor.latlngs[index] = position;
                polyline.editor.refresh();
                updatePathInput();
                updateDistance();
                updateWidthInput();
            });

            marker.on('dragend', function(event) {
                var marker = event.target;
                var position = marker.getLatLng();
                var index = markers.indexOf(marker);

                polyline.editor.latlngs[index] = position;
                polyline.editor.refresh();

                marker.setPopupContent("Latitude: " + position.lat.toFixed(5) + "<br>Longitude: " + position.lng.toFixed(5)).openPopup();
                updatePathInput();
                updateDistance();
                updateWidthInput();
            });
        });

        function updatePathInput() {
            var encodedPath = encodePolyline(polyline.getLatLngs().map(function(latlng) {
                return [latlng.lat, latlng.lng];
            }));
            document.getElementById('paths').value = encodedPath;
        }

        function updateDistance() {
            var distance = L.GeometryUtil.length(polyline);
            document.getElementById('panjang').value = (distance / 1000).toFixed(2); // converting meters to kilometers
        }

        function updateWidthInput() {
            var width = calculateWidth();
            document.getElementById('lebar').value = width;
        }

        function calculateWidth() {
            if (polyline.getLatLngs().length < 2) {
                return '';
            }

            var latlngs = polyline.getLatLngs();
            var startPoint = latlngs[0];
            var endPoint = latlngs[latlngs.length - 1];

            var lat1 = startPoint.lat;
            var lng1 = startPoint.lng;
            var lat2 = endPoint.lat;
            var lng2 = endPoint.lng;

            // Approximate width calculation
            var distance = L.latLng(lat1, lng1).distanceTo(L.latLng(lat2, lng2));
            var width = Math.round(distance * 0.05); // Assumption: 1 meter is equal to 0.05 units of width

            return width;
        }

        // Add event listener to ensure width is set
        document.getElementById('lebar').addEventListener('input', updateWidthInput);

        // Submit form handler
        document.getElementById('ruasjalan-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var form = new FormData(this);

            fetch('https://gisapis.manpits.xyz/api/ruasjalan', {
                method: 'POST',
                body: form,
                headers: {
                    'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Ruas Jalan Data submitted:', data);

                // Clear map and form
                if (polyline) {
                    mymap.removeLayer(polyline);
                }

                markers.forEach(function(marker) {
                    mymap.removeLayer(marker);
                });

                polylinePoints = [];
                markers = [];

                document.getElementById('paths').value = '';
                document.getElementById('panjang').value = '';
                document.getElementById('lebar').value = '';
                document.getElementById('ruasjalan-form').reset();

                // Display alert or notification for successful submission
                alert('Ruas Jalan Data submitted successfully!');
            })
            .catch(error => {
                console.error('Error submitting Ruas Jalan Data:', error);

                // Display alert or notification for error
                alert('Error submitting Ruas Jalan Data. Please try again.');
            });
        });

        // Get Ruas Jalan data and display on the map
        document.getElementById('get-ruas-jalan').addEventListener('click', function() {
            var apiToken = "{{ session('api_token') }}";
            fetch('https://gisapis.manpits.xyz/api/ruasjalan', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + apiToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Ruas Jalan Data:', data);

                // Example of decoding the polyline from data received
                if (data && data.status === 'success' && data.ruasjalan && data.ruasjalan.length > 0) {
                    data.ruasjalan.forEach(function(ruas) {
                        var decodedPoints = decodePolyline(ruas.paths);
                        console.log('Decoded Polyline:', decodedPoints);

                        // Draw polyline on map
                        var newPolyline = L.polyline(decodedPoints, { color: 'blue' }).addTo(mymap);

                        // Add popup to the polyline
                        var popupContent = `
                            <h5>${ruas.nama_ruas}</h5>
                            <p>Kode Ruas: ${ruas.kode_ruas}</p>
                            <p>Panjang: ${ruas.panjang} km</p>
                            <p>Lebar: ${ruas.lebar} m</p>
                            <p>Keterangan: ${ruas.keterangan}</p>
                            <button type="button" class="btn btn-danger btn-sm delete-polyline" data-id="${ruas.id}">Delete</button>
                        `;
                        newPolyline.bindPopup(popupContent);

                        // Event listener for delete button
                        newPolyline.on('popupopen', function() {
                            document.querySelector('.delete-polyline').addEventListener('click', function() {
                                var ruasId = this.getAttribute('data-id');

                                // Send delete request to API (if needed)
                                fetch(`https://gisapis.manpits.xyz/api/ruasjalan/${ruasId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Authorization': 'Bearer ' + apiToken,
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (response.ok) {
                                        // Remove polyline from map
                                        mymap.removeLayer(newPolyline);
                                        alert('Polyline deleted successfully!');
                                    } else {
                                        alert('Error deleting polyline');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error deleting polyline:', error);
                                    alert('Error deleting polyline');
                                });
                            });
                        });

                        mymap.fitBounds(newPolyline.getBounds());

                        // Append data to modal
                        var ruasJalanDiv = document.createElement('div');
                        ruasJalanDiv.classList.add('card', 'mb-3');
                        ruasJalanDiv.innerHTML = `
                            <div class="card-body">
                                <h5 class="card-title">${ruas.nama_ruas}</h5>
                                <p class="card-text">Kode Ruas: ${ruas.kode_ruas}</p>
                                <p class="card-text">Panjang: ${ruas.panjang} km</p>
                                <p class="card-text">Lebar: ${ruas.lebar} m</p>
                                <p class="card-text">Keterangan: ${ruas.keterangan}</p>
                                <button type="button" class="btn btn-primary" onclick="showModal(${ruas.id})">Detail</button>
                            </div>
                        `;
                        document.getElementById('ruasJalanList').appendChild(ruasJalanDiv);
                    });
                } else {
                    console.error('No Ruas Jalan data found');
                }
            })
            .catch(error => {
                console.error('Error fetching Ruas Jalan:', error);
            });
        });

        // Function to decode polyline points
        function decodePolyline(encoded) {
            var currentPosition = 0;
            var currentLat = 0;
            var currentLng = 0;
            var dataLength = encoded.length;
            var polyline = [];

            while (currentPosition < dataLength) {
                var shift = 0;
                var result = 0;
                var byte = null;

                do {
                    byte = encoded.charCodeAt(currentPosition++) - 63;
                    result |= (byte & 0x1f) << shift;
                    shift += 5;
                } while (byte >= 0x20);

                var deltaLat = ((result & 1) ? ~(result >> 1) : (result >> 1));
                currentLat += deltaLat;

                shift = 0;
                result = 0;

                do {
                    byte = encoded.charCodeAt(currentPosition++) - 63;
                    result |= (byte & 0x1f) << shift;
                    shift += 5;
                } while (byte >= 0x20);

                var deltaLng = ((result & 1) ? ~(result >> 1) : (result >> 1));
                currentLng += deltaLng;

                polyline.push([(currentLat / 1e5), (currentLng / 1e5)]);
            }

            return polyline;
        }

        // melihat token di console
        console.log('API Token:', "{{ session('api_token') }}");
    </script>



</body>
</html>
