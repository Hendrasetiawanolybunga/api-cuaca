@extends('layouts.app')

@section('title', 'Dashboard - Cuaca & Harga Pasar')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
        :root {
            --bs-green-primary: #28a745;
            --bs-green-light: #e6ffe6;
            --bs-orange-primary: #ffc107;
            --bs-orange-light: #fff8e6;
        }
        .navbar-brand {
            font-weight: bold;
            color: var(--bs-green-primary) !important;
        }
        .footer {
            background-color: #e9ecef;
            padding: 20px 0;
            color: #6c757d;
        }
        .bg-card-green { background-color: var(--bs-green-light); }
        .bg-card-orange { background-color: var(--bs-orange-light); }
        .hero-section {
            background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), url('https://placehold.co/1200x400/28a745/ffffff?text=Lahan+Kering+Kupang') no-repeat center center;
            background-size: cover;
            padding: 60px 0;
            border-radius: 10px;
            margin-bottom: 40px;
        }
        .card {
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .weather-icon {
            font-size: 3rem;
            color: var(--bs-green-primary);
        }
        .weather-info p {
            margin-bottom: 0;
        }
        .forecast-card {
            padding: 10px;
            border-radius: 8px;
            background-color: var(--bs-green-light);
            transition: all 0.3s ease;
        }
        .forecast-card:hover {
            background-color: var(--bs-green-primary);
            color: white;
            transform: scale(1.05);
        }
        .forecast-card:hover .bi {
            color: white;
        }
        .forecast-card .bi {
            color: var(--bs-green-primary);
            font-size: 2rem;
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            z-index: 1;
        }
    </style>
@endpush
@section('content')

    <div class="container">
        <div class="row justify-content-center hero-section mb-4">
            <div class="col-md-10 text-center text-dark">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-check2-circle text-success"></i> FarmEase
                </h1>
                <p class="lead text-muted">
                    Informasi Cuaca & Harga Pasar Terkini untuk Petani Lahan Kering di Kabupaten Kupang.
                </p>
            </div>
        </div>

            <div class="row g-4 mb-5">
                {{-- Dropdown Pilihan Kebun --}}
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm bg-white">
                        <div class="card-header bg-card-green text-dark">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-geo-alt me-2"></i> Pilih Lokasi Kebun</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <select id="kebun-selector" class="form-select form-select-lg shadow-sm">
                                        @if(isset($kebunList) && $kebunList->count() > 0)
                                            @foreach($kebunList as $kebun)
                                                <option value="{{ $kebun->kebun_id }}" {{ $selectedKebunId == $kebun->kebun_id ? 'selected' : '' }}>{{ $kebun->kebun_nama }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Tidak ada kebun tersedia</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                    <button id="refresh-weather" class="btn btn-success"><i class="bi bi-arrow-clockwise me-2"></i> Perbarui Data Cuaca</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Bagian Peta --}}
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 bg-white">
                        <div class="card-header bg-card-green text-dark">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-map me-2"></i> Lokasi Kebun</h5>
                        </div>
                        <div class="card-body p-3">
                            <div id="map"></div>
                            <small class="text-muted mt-2 d-block text-center">Peta menampilkan lokasi kebun yang dipilih.</small>
                        </div>
                    </div>
                </div>

                {{-- Bagian Cuaca (akan diperbarui secara dinamis) --}}
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 bg-card-green" id="weather-card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                             <div id="current-weather">
                                <i class="bi bi-cloud-sun weather-icon"></i>
                                <h2 class="display-4 fw-bold mt-2 text-success">{{ is_object($dataCuacaSaatIni) ? round($dataCuacaSaatIni->main->temp) : 'N/A' }}°C</h2>
                                <p class="lead text-muted mb-3">{{ is_object($dataCuacaSaatIni) ? ucwords($dataCuacaSaatIni->weather[0]->description) : 'Data tidak tersedia' }}</p>
                                <div class="row g-2 text-center">
                                    <div class="col-6">
                                        <p class="mb-0 text-dark"><i class="bi bi-droplet-half me-1 text-info"></i> Kelembaban</p>
                                        <h6 class="fw-bold">{{ is_object($dataCuacaSaatIni) ? $dataCuacaSaatIni->main->humidity : 'N/A' }}%</h6>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-0 text-dark"><i class="bi bi-wind me-1 text-primary"></i> Angin</p>
                                        <h6 class="fw-bold">{{ is_object($dataCuacaSaatIni) ? round($dataCuacaSaatIni->wind->speed) : 'N/A' }} km/j</h6>
                                    </div>
                                </div>
                                <small class="text-muted mt-3 d-block">Data dari OpenWeatherMap</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Prediksi Cuaca 5 Hari (akan diperbarui secara dinamis) --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-12">
                    <div class="card shadow-sm bg-card-green">
                        <div class="card-header bg-white border-bottom-0">
                            <h5 class="mb-0"><i class="bi bi-graph-up me-2 text-success"></i> Prediksi Cuaca 5 Hari ke Depan</h5>
                        </div>
                        <div class="card-body" id="forecast-section">
                             <div class="row row-cols-2 row-cols-md-5 g-2 text-center">
                                @if (is_object($dataForecast) && isset($dataForecast->list))
                                    @php
                                        $uniqueDays = [];
                                        $forecastsToShow = [];
                                        foreach ($dataForecast->list as $forecast) {
                                            $date = date('Y-m-d', $forecast->dt);
                                            if (!in_array($date, $uniqueDays)) {
                                                $uniqueDays[] = $date;
                                                $forecastsToShow[] = $forecast;
                                                if (count($uniqueDays) >= 5) break;
                                            }
                                        }
                                    @endphp
                                    @foreach($forecastsToShow as $forecast)
                                        <div class="col">
                                            <div class="forecast-card d-flex flex-column align-items-center">
                                                <small class="fw-bold">{{ date('D', $forecast->dt) }}</small>
                                                <i class="bi {{ strtolower($forecast->weather[0]->main) == 'clear' ? 'bi-sun' : (strtolower($forecast->weather[0]->main) == 'rain' ? 'bi-cloud-rain' : 'bi-cloud') }} my-2"></i>
                                                <small class="fw-bold">{{ round($forecast->main->temp) }}°C</small>
                                                <small class="text-muted">{{ ucwords($forecast->weather[0]->description) }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center text-muted">Data prediksi tidak tersedia.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>

    <footer class="footer mt-auto py-4 bg-white shadow-sm">
        <div class="container text-center">
            <span class="text-muted">© {{ date('Y') }} FarmEase. Dibuat untuk Petani Kecil Kabupaten Kupang.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Inisialisasi peta
        let map = L.map('map').setView([{{ $lat ?? -10.0647185 }}, {{ $lon ?? 123.8625032 }}], 10);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });

        const baseLayers = {
            "Default": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
            "Satelit": satelliteLayer
        };

        L.control.layers(baseLayers).addTo(map);

        let currentMarker;
        
        // Inisialisasi marker pada lokasi awal
        if ({{ $lat ?? 'null' }} && {{ $lon ?? 'null' }}) {
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }
            currentMarker = L.marker([{{ $lat }}, {{ $lon }}]).addTo(map);
            map.setView([{{ $lat }}, {{ $lon }}], 13);
        }
        
        // Event listener untuk dropdown kebun
        document.getElementById('kebun-selector').addEventListener('change', function() {
            getWeatherDataForSelectedKebun();
        });
        
        // Event listener untuk tombol refresh
        document.getElementById('refresh-weather').addEventListener('click', function() {
            getWeatherDataForSelectedKebun();
        });
        
        // Fungsi untuk mendapatkan data cuaca berdasarkan kebun yang dipilih
        function getWeatherDataForSelectedKebun() {
            const kebunId = document.getElementById('kebun-selector').value;
            
            if (!kebunId) {
                alert('Silakan pilih kebun terlebih dahulu');
                return;
            }
            
            const weatherCard = document.getElementById('current-weather');
            const forecastSection = document.getElementById('forecast-section');
            weatherCard.innerHTML = '<div class="spinner-border text-success" role="status"></div><p class="mt-3">Mengambil data...</p>';
            forecastSection.innerHTML = '<div class="text-center"><div class="spinner-border text-success" role="status"></div><p class="mt-3">Mengambil data...</p></div>';

            axios.get(`/get-weather-by-kebun?kebun_id=${kebunId}`)
                .then(response => {
                    const data = response.data;
                    updateWeatherUI(data.dataCuacaSaatIni, data.dataForecast);
                    
                    // Update peta dengan lokasi kebun
                    if (data.lat && data.lon) {
                        if (currentMarker) {
                            map.removeLayer(currentMarker);
                        }
                        currentMarker = L.marker([data.lat, data.lon]).addTo(map);
                        map.setView([data.lat, data.lon], 13);
                    }
                })
                .catch(error => {
                    weatherCard.innerHTML = '<p class="text-danger mt-3">Gagal mengambil data cuaca.</p>';
                    forecastSection.innerHTML = '<p class="text-center text-danger mt-3">Gagal mengambil data prediksi.</p>';
                    console.error('Error fetching weather data:', error);
                });
        }

        function updateWeatherUI(current, forecast) {
            const weatherCard = document.getElementById('current-weather');
            if (current) {
                weatherCard.innerHTML = `
                    <i class="bi bi-${getWeatherIcon(current.weather[0].main)} weather-icon"></i>
                    <h2 class="display-4 fw-bold mt-2 text-success">${Math.round(current.main.temp)}°C</h2>
                    <p class="lead text-muted mb-3">${ucwords(current.weather[0].description)}</p>
                    <div class="row g-2 text-center">
                        <div class="col-6">
                            <p class="mb-0 text-dark"><i class="bi bi-droplet-half me-1 text-info"></i> Kelembaban</p>
                            <h6 class="fw-bold">${current.main.humidity}%</h6>
                        </div>
                        <div class="col-6">
                            <p class="mb-0 text-dark"><i class="bi bi-wind me-1 text-primary"></i> Angin</p>
                            <h6 class="fw-bold">${Math.round(current.wind.speed)} km/j</h6>
                        </div>
                    </div>
                    <small class="text-muted mt-3 d-block">Data dari OpenWeatherMap</small>
                `;
            } else {
                weatherCard.innerHTML = '<p class="text-danger mt-3">Data cuaca tidak tersedia.</p>';
            }

            const forecastSection = document.getElementById('forecast-section');
            if (forecast && forecast.list.length > 0) {
                let forecastHtml = '<div class="row row-cols-2 row-cols-md-5 g-2 text-center">';
                let uniqueDays = [];
                forecast.list.forEach(item => {
                    const date = new Date(item.dt * 1000).toISOString().split('T')[0];
                    if (!uniqueDays.includes(date) && uniqueDays.length < 5) {
                        uniqueDays.push(date);
                        forecastHtml += `
                            <div class="col">
                                <div class="forecast-card d-flex flex-column align-items-center">
                                    <small class="fw-bold">${new Date(item.dt * 1000).toLocaleDateString('id-ID', { weekday: 'short' })}</small>
                                    <i class="bi bi-${getWeatherIcon(item.weather[0].main)} my-2"></i>
                                    <small class="fw-bold">${Math.round(item.main.temp)}°C</small>
                                    <small class="text-muted">${ucwords(item.weather[0].description)}</small>
                                </div>
                            </div>
                        `;
                    }
                });
                forecastHtml += '</div>';
                forecastSection.innerHTML = forecastHtml;
            } else {
                forecastSection.innerHTML = '<p class="text-center text-muted">Data prediksi tidak tersedia.</p>';
            }
        }

        function getWeatherIcon(main) {
            main = main.toLowerCase();
            if (main === 'clear') return 'sun';
            if (main === 'clouds') return 'cloud';
            if (main === 'rain') return 'cloud-rain';
            if (main === 'drizzle') return 'cloud-drizzle';
            if (main === 'thunderstorm') return 'cloud-lightning';
            if (main === 'snow') return 'cloud-snow';
            return 'cloud';
        }

        function ucwords(str) {
            return str.replace(/(^|\s)\S/g, function(t) { return t.toUpperCase() });
        }
    </script>
@endsection