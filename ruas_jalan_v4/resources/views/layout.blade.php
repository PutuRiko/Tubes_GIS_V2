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
                <button id="click-me" class="btn btn-success nav-link">
                    <i class="bi bi-geo-alt"></i>
                    <span>CLICK ME!</span>
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
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" id="provinsi">
                            <option selected disabled>Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten" class="form-label">Kabupaten</label>
                        <select class="form-select" id="kabupaten">
                            <option selected disabled>Pilih Kabupaten</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <select class="form-select" id="kecamatan">
                            <option selected disabled>Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="desa" class="form-label">Desa</label>
                        <select class="form-select" id="desa">
                            <option selected disabled>Pilih Desa</option>
                        </select>
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
                        <input type="text" class="form-control" id="panjang" name="panjang" placeholder="Panjang Jalan (KM)">
                    </div>
                    <div class="mb-3">
                        <label for="lebar" class="form-label">Lebar</label>
                        <input type="text" class="form-control" id="lebar" name="lebar" placeholder="Lebar Jalan (M)">
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var mymap = L.map('mapid', { zoomControl: false, editable: true }).setView([-8.409518, 115.188919], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(mymap);

        var polylinePoints = [];
        var polyline = L.polyline(polylinePoints, { color: 'red', draggable: true }).addTo(mymap);
        var markers = [];

        mymap.on('click', function(event) {
            var latlng = event.latlng;
            polylinePoints.push(latlng);
            updatePolyline();
            updateEncodedPath();
            updatePanjang();
            updateLebar();
        });

        mymap.on('contextmenu', function(event) {
            if (polylinePoints.length > 0) {
                polylinePoints.pop();
                updatePolyline();
                updateEncodedPath();
                updatePanjang();
                updateLebar();
            }
        });

        // Add event listener to update polylinePoints on polyline edit
        polyline.on('edit', function(event) {
            polylinePoints = polyline.getLatLngs();
            updatePolyline();
            updateEncodedPath();
            updatePanjang();
            updateLebar();
        });

        // Function to update polyline and markers
        function updatePolyline() {
            clearMap();

            polyline = L.polyline(polylinePoints, { color: 'red', draggable: true }).addTo(mymap);

            polylinePoints.forEach(function(point, index) {
                var marker = L.marker(point, { draggable: true }).addTo(mymap);
                markers.push(marker);

                marker.bindPopup("Latitude: " + point.lat + "<br>Longitude: " + point.lng);

                marker.on('drag', function(event) {
                    var newPosition = event.target.getLatLng();
                    marker.setLatLng(newPosition);
                    polylinePoints[index] = newPosition;
                    polyline.setLatLngs(polylinePoints);
                    marker.getPopup().setContent("Latitude: " + newPosition.lat + "<br>Longitude: " + newPosition.lng).openPopup();
                    updateEncodedPath();
                    updatePanjang();
                    updateLebar();
                });
            });
        }

        // Function to clear map and reset data
        function clearMap() {
            if (polyline) {
                mymap.removeLayer(polyline);
            }
            markers.forEach(function(marker) {
                mymap.removeLayer(marker);
            });
            markers = [];
        }

        // Show instructions popup when button is clicked
        document.getElementById('click-me').addEventListener('click', function() {
            alert("Untuk menggambar marker dan garis silahkan klik kiri dan untuk menghapusnya silahkan klik kanan");
        });

        // melihat token di console
        console.log('API Token:', "{{ session('api_token') }}");

        // Function to update encoded path in the form
        function updateEncodedPath() {
            var encodedPath = encodePolyline(polylinePoints);
            document.getElementById('paths').value = encodedPath;
        }

        // Function to encode polyline points
        function encodePolyline(points) {
            var result = '';
            var prevLat = 0;
            var prevLng = 0;

            points.forEach(function(point) {
                var lat = Math.round(point.lat * 1e5);
                var lng = Math.round(point.lng * 1e5);

                var dLat = lat - prevLat;
                var dLng = lng - prevLng;

                result += encodeNumber(dLat) + encodeNumber(dLng);

                prevLat = lat;
                prevLng = lng;
            });

            return result;
        }

        function encodeNumber(num) {
            var sgnNum = num << 1;
            if (num < 0) {
                sgnNum = ~(sgnNum);
            }
            var encoded = '';
            while (sgnNum >= 0x20) {
                encoded += String.fromCharCode((0x20 | (sgnNum & 0x1f)) + 63);
                sgnNum >>= 5;
            }
            encoded += String.fromCharCode(sgnNum + 63);
            return encoded;
        }

        // Function to update the length of the polyline in the form
        function updatePanjang() {
            var panjang = calculatePolylineLength(polylinePoints);
            document.getElementById('panjang').value = panjang.toFixed(3); // Display the length in kilometers with 3 decimal places
        }

        // Function to calculate the length of a polyline in kilometers
        function calculatePolylineLength(points) {
            var length = 0;
            for (var i = 1; i < points.length; i++) {
                var p1 = points[i - 1];
                var p2 = points[i];
                length += p1.distanceTo(p2) / 1000; // Convert meters to kilometers
            }
            return length;
        }

        // Function to update the width of the road in the form
        function updateLebar() {
            var lebar = document.getElementById('lebar').value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            
            const headers = {
                'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                'Accept': 'application/json'
            };

            axios.get('https://gisapis.manpits.xyz/api/mregion', { headers: headers })
                .then(response => {
                    const provinces = response.data.provinsi;
                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id;
                        option.textContent = province.provinsi;
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching provinces:', error);
                });

            provinsiSelect.addEventListener('change', function() {
                const selectedProvinceId = this.value;
                kabupatenSelect.innerHTML = '<option selected disabled>Pilih Kabupaten</option>'; // Reset kabupaten options

                axios.get(`https://gisapis.manpits.xyz/api/kabupaten/${selectedProvinceId}`, { headers: headers })
                    .then(response => {
                        const kabupaten = response.data.kabupaten;
                        kabupaten.forEach(kab => {
                            const option = document.createElement('option');
                            option.value = kab.id;
                            option.textContent = kab.value;
                            kabupatenSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching kabupaten:', error);
                    });
            });
        });
    </script>
</body>
</html>