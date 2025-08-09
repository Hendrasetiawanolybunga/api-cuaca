<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FarmEase')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .auth-container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo h1 {
            color: var(--green-primary);
            font-weight: 700;
            font-size: 2.5rem;
        }
        
        .auth-logo i {
            font-size: 3rem;
            color: var(--green-primary);
            margin-bottom: 1rem;
        }
        
        .auth-card {
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }
        
        .auth-header {
            background: var(--green-primary);
            color: white;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--gray-dark);
        }
        
        .auth-footer a {
            color: var(--green-primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .btn-auth {
            background-color: var(--green-primary);
            border-color: var(--green-primary);
            color: white;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }
        
        .btn-auth:hover {
            background-color: var(--green-hover);
            border-color: var(--green-hover);
            color: white;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="auth-container">
        <div class="auth-logo">
            <i class="fa-solid fa-leaf"></i>
            <h1>FarmEase</h1>
        </div>
        
        @yield('content')
        
        <div class="auth-footer">
            <p>&copy; {{ date('Y') }} FarmEase. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>