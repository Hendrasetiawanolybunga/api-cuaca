<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FarmEase Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @stack('styles')
</head>

<body>
    <!-- Mobile Menu Toggle -->
    <button class="navbar-toggler" type="button" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-center mb-4">
            <i class="fa-solid fa-leaf me-2"></i> FarmEase
        </h4>

        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        @auth
            {{-- Menu untuk admin dan penyuluh --}}
            @if (in_array(Auth::user()->pengguna_peran, ['admin', 'penyuluh']))
                <a href="{{ url('/user/pengguna') }}" class="{{ request()->is('user/pengguna*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Pengguna
                </a>
            @endif

            {{-- Menu yang bisa diakses semua peran --}}
            <a href="{{ url('/user/kebun') }}" class="{{ request()->is('user/kebun*') ? 'active' : '' }}">
                <i class="fa-solid fa-tree"></i> Kebun
            </a>
            <a href="{{ url('/user/musim-tanam') }}" class="{{ request()->is('user/musim-tanam*') ? 'active' : '' }}">
                <i class="fa-solid fa-seedling"></i> Musim Tanam
            </a>
            <a href="{{ url('/user/pestisida') }}" class="{{ request()->is('user/pestisida*') ? 'active' : '' }}">
                <i class="fa-solid fa-spray-can-sparkles"></i> Pestisida
            </a>
            <a href="{{ url('/user/pupuk') }}" class="{{ request()->is('user/pupuk*') ? 'active' : '' }}">
                <i class="fa-solid fa-flask"></i> Pupuk
            </a>
        @endauth
    </div>

    <!-- Content -->
    <div class="content">
        @auth
            <div class="d-flex justify-content-end mb-3">
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin keluat dari akun?')">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        {{ Auth::user()->pengguna_nama }} | Logout <i class="fas fa-sign-out-alt me-1"></i>
                    </button>
                </form>
            </div>
        @endauth
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnToggle = sidebarToggle.contains(event.target);

                    if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth <= 768 && sidebar
                        .classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
