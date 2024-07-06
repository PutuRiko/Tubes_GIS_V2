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
            height: 450px; 
            width: 65%;
            margin: 20px auto; 
            display: block; 
            border: 5px solid black;
            border-radius: 8px; 
            margin-top: 60px;
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
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Welcome</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>User</h6>
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
                        <input type="text" class="form-control" id="paths" name="paths" placeholder="Encoded Paths">
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" id="provinsi">
                            <option selected disabled>Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten" class="form-label">Kabupaten/Kota</label>
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
                        <input type="text" class="form-control" id="desa_id" name="desa_id" placeholder="ID Desa">
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
                        <label for="panjang" class="form-label">Panjang Jalan (KM)</label>
                        <input type="text" class="form-control" id="panjang" name="panjang" placeholder="Panjang Jalan (KM)">
                    </div>
                    <div class="mb-3">
                        <label for="lebar" class="form-label">Lebar Jalan (M)</label>
                        <input type="text" class="form-control" id="lebar" name="lebar" placeholder="Lebar Jalan (M)">
                    </div>
                    <div class="mb-3">
                        <label for="eksisting" class="form-label">Perkerasan Jalan</label>
                        <select class="form-select" id="eksisting" name="eksisting">
                            <option selected disabled>Pilih Perkerasan Jalan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eksisting_id" class="form-label">Eksisting ID</label>
                        <input type="text" class="form-control" id="eksisting_id" name="eksisting_id" placeholder="ID Eksisting">
                    </div>
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi Jalan</label>
                        <select class="form-select" id="kondisi" name="kondisi">
                            <option selected disabled>Pilih Kondisi Jalan</option>
                        </select>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="kondisi_id" class="form-label">Kondisi ID</label>
                        <input type="text" class="form-control" id="kondisi_id" name="kondisi_id" placeholder="ID Kondisi">
                    </div>
                    <div class="mb-3">
                        <label for="jenisjalan" class="form-label">Jenis Jalan</label>
                        <select class="form-select" id="jenisjalan" name="jenisjalan">
                            <option selected disabled>Pilih Jenis Jalan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenisjalan_id" class="form-label">Jenis Jalan ID</label>
                        <input type="text" class="form-control" id="jenisjalan_id" name="jenisjalan_id" placeholder="ID Jenis Jalan">
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
        <div class="table-wrapper">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Desa ID</th>
                        <th>Kode Ruas</th>
                        <th>Nama Ruas</th>
                        <th>Panjang (KM)</th>
                        <th>Lebar (M)</th>
                        <th>Perkerasan Jalan ID</th>
                        <th>Kondisi ID</th>
                        <th>Jenis Jalan ID</th>
                        <th>Keterangan</th>
                        <th>Actions</th>
                        <th>Paths</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data rows will be added here -->
                </tbody>
            </table>
        </div>
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
        var polyline;
        var polylineMap = {};
        var eksistingMap = {};
        var kondisiMap = {};
        var jenisJalanMap = {};
        var desaMap = {};

        document.getElementById('click-me').addEventListener('click', function() {
            alert("Untuk menggambar marker dan garis silahkan klik kiri dan untuk menghapusnya silahkan klik kanan");
        });

        mymap.on('click', function(event) {
            var latlng = event.latlng;
            polylinePoints.push(latlng);
            updatePolyline();
            updateEncodedPath();
            updatePanjang();
        });

        mymap.on('contextmenu', function(event) {
            if (polylinePoints.length > 0) {
                polylinePoints.pop();
                updatePolyline();
                updateEncodedPath();
                updatePanjang();
            }
        });

        polyline.on('edit', function(event) {
            polylinePoints = polyline.getLatLngs();
            updatePolyline();
            updateEncodedPath();
            updatePanjang();
        });

        function updatePolyline() {
            clearMap();

            polyline = L.polyline(polylinePoints, { color: 'purple', draggable: true }).addTo(mymap);

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
                });
            });
        }

        function clearMap() {
            if (polyline) {
                mymap.removeLayer(polyline);
            }
            markers.forEach(function(marker) {
                mymap.removeLayer(marker);
            });
            markers = [];
        }

        function updateEncodedPath() {
            var encodedPath = encodePolyline(polylinePoints);
            document.getElementById('paths').value = encodedPath;
        }

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

        function updatePanjang() {
            var panjang = calculatePolylineLength(polylinePoints);
            document.getElementById('panjang').value = panjang.toFixed(1);
        }

        function calculatePolylineLength(points) {
            var length = 0;
            for (var i = 1; i < points.length; i++) {
                var p1 = points[i - 1];
                var p2 = points[i];
                length += p1.distanceTo(p2) / 1000;
            }
            return length;
        }

        console.log('API Token:', "{{ session('api_token') }}");

        document.addEventListener('DOMContentLoaded', function() {
            
            const headers = {
                'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                'Accept': 'application/json'
            };

            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');
            const desaIdInput = document.getElementById('desa_id'); 
            const eksistingSelect = document.getElementById('eksisting');
            const eksistingIdInput = document.getElementById('eksisting_id'); 
            const kondisiSelect = document.getElementById('kondisi');
            const kondisiIdInput = document.getElementById('kondisi_id'); 
            const jenisJalanSelect = document.getElementById('jenisjalan'); 
            const jenisJalanIdInput = document.getElementById('jenisjalan_id'); 

            axios.get('https://gisapis.manpits.xyz/api/meksisting', { headers: headers })
                .then(response => {
                    const eksistingData = response.data.eksisting;
                    eksistingData.forEach(eksisting => {
                        eksistingMap[eksisting.id] = eksisting.eksisting;
                        const option = document.createElement('option');
                        option.value = eksisting.id;
                        option.textContent = eksisting.eksisting;
                        eksistingSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching eksisting:', error);
                });
            
            eksistingSelect.addEventListener('change', function() {
                const selectedEksistingId = this.value;
                eksistingIdInput.value = selectedEksistingId;
            });

            axios.get('https://gisapis.manpits.xyz/api/mkondisi', { headers: headers })
                .then(response => {
                    const kondisiData = response.data.eksisting;
                    kondisiData.forEach(kondisi => {
                        kondisiMap[kondisi.id] = kondisi.kondisi;
                        const option = document.createElement('option');
                        option.value = kondisi.id;
                        option.textContent = kondisi.kondisi;
                        kondisiSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching kondisi:', error);
                });
            
            kondisiSelect.addEventListener('change', function() {
                const selectedKondisiId = this.value;
                kondisiIdInput.value = selectedKondisiId; 
            });

            axios.get('https://gisapis.manpits.xyz/api/mjenisjalan', { headers: headers })
                .then(response => {
                    const jenisJalanData = response.data.eksisting;
                    jenisJalanData.forEach(jenisJalan => {
                        jenisJalanMap[jenisJalan.id] = jenisJalan.jenisjalan;
                        const option = document.createElement('option');
                        option.value = jenisJalan.id;
                        option.textContent = jenisJalan.jenisjalan;
                        jenisJalanSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching jenis jalan:', error);
                });

            jenisJalanSelect.addEventListener('change', function() {
                const selectedJenisJalanId = this.value;
                jenisJalanIdInput.value = selectedJenisJalanId; 
            });

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
                kabupatenSelect.innerHTML = '<option selected disabled>Pilih Kabupaten</option>';
                kecamatanSelect.innerHTML = '<option selected disabled>Pilih Kecamatan</option>';
                desaSelect.innerHTML = '<option selected disabled>Pilih Desa</option>';

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

            kabupatenSelect.addEventListener('change', function() {
                const selectedKabupatenId = this.value;
                kecamatanSelect.innerHTML = '<option selected disabled>Pilih Kecamatan</option>';
                desaSelect.innerHTML = '<option selected disabled>Pilih Desa</option>';

                axios.get(`https://gisapis.manpits.xyz/api/kecamatan/${selectedKabupatenId}`, { headers: headers })
                    .then(response => {
                        const kecamatan = response.data.kecamatan;
                        kecamatan.forEach(kec => {
                            const option = document.createElement('option');
                            option.value = kec.id;
                            option.textContent = kec.value;
                            kecamatanSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching kecamatan:', error);
                    });
            });

            kecamatanSelect.addEventListener('change', function() {
                const selectedKecamatanId = this.value;
                desaSelect.innerHTML = '<option selected disabled>Pilih Desa</option>';

                axios.get(`https://gisapis.manpits.xyz/api/desa/${selectedKecamatanId}`, { headers: headers })
                    .then(response => {
                        const desa = response.data.desa;
                        desa.forEach(des => {
                            desaMap[des.id] = des.desa;
                            const option = document.createElement('option');
                            option.value = des.id;
                            option.textContent = des.value;
                            desaSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching desa:', error);
                    });
            });

            desaSelect.addEventListener('change', function() {
                const selectedDesaId = this.value;
                desaIdInput.value = selectedDesaId;
            });
        });


        document.getElementById('submitRuasJalan').addEventListener('click', function (e) {
            e.preventDefault(); 

            var formData = {
                paths: document.getElementById('paths').value,
                desa_id: document.getElementById('desa_id').value,
                kode_ruas: document.getElementById('kode_ruas').value,
                nama_ruas: document.getElementById('nama_ruas').value,
                panjang: document.getElementById('panjang').value,
                lebar: document.getElementById('lebar').value,
                eksisting_id: document.getElementById('eksisting_id').value,
                kondisi_id: document.getElementById('kondisi_id').value,
                jenisjalan_id: document.getElementById('jenisjalan_id').value,
                keterangan: document.getElementById('keterangan').value
            };

            fetch('https://gisapis.manpits.xyz/api/ruasjalan', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data Berhasil Ditambahkan');
                    fetchAndDisplayData();
                    location.reload();
                } else {
                    alert('Data berhasil ditambahkan, silahkan refresh halaman');
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data');
            });

            function clearForm() {
                document.getElementById('ruasjalan-form').reset();
                polylinePoints = [];
                updatePolyline();
            }
        });

        function fetchAndDisplayData() {
            fetch('https://gisapis.manpits.xyz/api/ruasjalan', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.ruasjalan) {
                    var tableBody = document.getElementById('tableBody');
                    tableBody.innerHTML = '';

                    data.ruasjalan.forEach(item => {
                        var decodedPath = decodePolyline(item.paths);
                        addPolylineToMap(decodedPath, item);

                        var row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${item.id}</td>
                            <td>${desaMap[item.desa_id] || item.desa_id}</td>
                            <td>${item.kode_ruas}</td>
                            <td>${item.nama_ruas}</td>
                            <td>${item.panjang}</td>
                            <td>${item.lebar}</td>
                            <td>${eksistingMap[item.eksisting_id] || item.eksisting_id}</td>
                            <td>${kondisiMap[item.kondisi_id] || item.kondisi_id}</td>
                            <td>${jenisJalanMap[item.jenisjalan_id] || item.jenisjalan_id}</td>
                            <td>${item.keterangan}</td>
                            <td>
                                <button class="btn btn-info" onclick="handleTampilkanPolyline(${item.id})">Tampilkan Polyline</button>
                                <button class="btn btn-warning" onclick="handleEditButtonClick(event)">Edit</button>
                                <button class="btn btn-danger" onclick="deleteData(${item.id})">Delete</button>
                            </td>
                            <td>${item.paths}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    alert('Error fetching data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        fetchAndDisplayData();

        function handleTampilkanPolyline(id) {
            const apiUrl = `https://gisapis.manpits.xyz/api/ruasjalan/${id}`;
            const headers = {
                'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                'Accept': 'application/json'
            };

            fetch(apiUrl, { headers: headers })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        const item = data.ruasjalan; 
                        const decodedPath = decodePolyline(item.paths);
                        
                        if (polyline) {
                            mymap.removeLayer(polyline);
                        }
                        
                        polyline = L.polyline(decodedPath).addTo(mymap);

                        const popupContent = `
                            <strong>ID:</strong> ${item.id}<br>
                            <strong>Desa:</strong> ${desaMap[item.desa_id] || item.desa_id}<br>
                            <strong>Nama Ruas:</strong> ${item.nama_ruas}<br>
                            <strong>Panjang:</strong> ${item.panjang}<br>
                            <strong>Lebar:</strong> ${item.lebar}<br>
                            <strong>Eksisting:</strong> ${eksistingMap[item.eksisting_id] || item.eksisting_id}<br>
                            <strong>Kondisi:</strong> ${kondisiMap[item.kondisi_id] || item.kondisi_id}<br>
                            <strong>Jenis Jalan:</strong> ${jenisJalanMap[item.jenisjalan_id] || item.jenisjalan_id}<br>
                            <strong>Keterangan:</strong> ${item.keterangan}
                        `;
                        
                        polyline.bindPopup(popupContent).openPopup();

                        mymap.fitBounds(polyline.getBounds());
                    } else {
                        alert('Data tidak ditemukan.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching polyline data:', error);
                    alert('Terjadi kesalahan saat mengambil data.');
                });
        }

        function addPolylineToMap(decodedPath, item) {
            const polyline = L.polyline(decodedPath).addTo(mymap);
            mymap.fitBounds(polyline.getBounds());

            return polyline;
        }

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

        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const headers = {
                    'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                    'Accept': 'application/json'
                };

                axios.delete(`https://gisapis.manpits.xyz/api/ruasjalan/${id}`, { headers: headers })
                    .then(response => {
                        alert('Data berhasil dihapus, silahkan refresh halaman');
                        removePolylineById(id);
                        var row = document.getElementById(`row-${id}`);
                        if (row) {
                            row.remove();
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                        alert('Terjadi kesalahan saat menghapus data');
                    });
            }
        }

        function removePolylineById(id) {
            var polyline = polylineMap[id];
            if (polyline) {
                mymap.removeLayer(polyline);
                delete polylineMap[id];
            }
        }

        function populateForm(data) {
            document.getElementById("paths").value = data.paths;
            document.getElementById("desa_id").value = data.desa_id;
            document.getElementById("kode_ruas").value = data.kode_ruas;
            document.getElementById("nama_ruas").value = data.nama_ruas;
            document.getElementById("panjang").value = data.panjang;
            document.getElementById("lebar").value = data.lebar;
            document.getElementById("eksisting_id").value = data.eksisting_id;
            document.getElementById("kondisi_id").value = data.kondisi_id;
            document.getElementById("jenisjalan_id").value = data.jenisjalan_id;
            document.getElementById("keterangan").value = data.keterangan;
        
            var decodedPath = decodePolyline(data.paths);
            polylinePoints = decodedPath.map(point => L.latLng(point[0], point[1]));
            updatePolyline();
        }

        function handleEditButtonClick(event) {
            const row = event.target.closest('tr');
            const data = {
                id: row.children[0].textContent,
                desa_id: row.children[1].textContent,
                kode_ruas: row.children[2].textContent,
                nama_ruas: row.children[3].textContent,
                panjang: row.children[4].textContent,
                lebar: row.children[5].textContent,
                eksisting_id: row.children[6].textContent,
                kondisi_id: row.children[7].textContent,
                jenisjalan_id: row.children[8].textContent,
                keterangan: row.children[9].textContent,
                paths: row.children[11].textContent,
            };
            
            populateForm(data);

            document.getElementById("submitRuasJalan").dataset.id = data.id;
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById('ruasjalan-form').addEventListener('submit', async (event) => {
                event.preventDefault();
                
                const id = document.getElementById("submitRuasJalan").dataset.id;
                const data = {
                    paths: document.getElementById("paths").value,
                    desa_id: document.getElementById("desa_id").value,
                    kode_ruas: document.getElementById("kode_ruas").value,
                    nama_ruas: document.getElementById("nama_ruas").value,
                    panjang: document.getElementById("panjang").value,
                    lebar: document.getElementById("lebar").value,
                    eksisting_id: document.getElementById("eksisting_id").value,
                    kondisi_id: document.getElementById("kondisi_id").value,
                    jenisjalan_id: document.getElementById("jenisjalan_id").value,
                    keterangan: document.getElementById("keterangan").value,
                };

                try {
                    const response = await fetch(`https://gisapis.manpits.xyz/api/ruasjalan/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': 'Bearer ' + "{{ session('api_token') }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        alert('Data berhasil diperbarui, silahkan refresh halaman');
                        location.reload(); 
                        clearForm();
                    } else {
                        alert('Gagal memperbarui data.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui data.');
                }
            });
        });
    </script>
</body>
</html>