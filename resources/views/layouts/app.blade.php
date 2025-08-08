<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: #fff;
            padding-top: 20px;
            position: fixed;
            width: 220px;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #495057;
            color: #fff;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                width: 100%;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4">Admin Panel</h4>
        <a href="{{ url('/admin/peran') }}" class="{{ request()->is('admin/peran*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-shield me-2"></i> Peran
        </a>
        <a href="{{ url('/admin/pengguna') }}" class="{{ request()->is('admin/pengguna*') ? 'active' : '' }}">
            <i class="fa-solid fa-users me-2"></i> Pengguna
        </a>
        <a href="{{ url('/admin/kebun') }}" class="{{ request()->is('admin/kebun*') ? 'active' : '' }}">
            <i class="fa-solid fa-tree me-2"></i> Kebun
        </a>
        <a href="{{ url('/admin/musim-tanam') }}" class="{{ request()->is('admin/musim-tanam*') ? 'active' : '' }}">
            <i class="fa-solid fa-seedling me-2"></i> Musim Tanam
        </a>
        <a href="{{ url('/admin/pestisida') }}" class="{{ request()->is('admin/pestisida*') ? 'active' : '' }}">
            <i class="fa-solid fa-spray-can-sparkles me-2"></i> Pestisida
        </a>
        <a href="{{ url('/admin/pupuk') }}" class="{{ request()->is('admin/pupuk*') ? 'active' : '' }}">
            <i class="fa-solid fa-flask me-2"></i> Pupuk
        </a>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
