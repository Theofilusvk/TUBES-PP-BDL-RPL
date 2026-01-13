<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Running Event Management') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Placeholder for Navbar until Vite compiles */
        .navbar {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .nav-link {
            color: var(--color-gray-medium);
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--color-primary);
        }
        .main-content {
            padding: 2rem;
            max-width: 1280px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="navbar">
            <div style="font-size: 1.25rem; font-weight: 700;">
                <span class="text-primary">RUN</span>Event
            </div>
            
            <div class="flex items-center">
                <!-- Role Badge Display (Mockup) -->
                @auth
                    @if(request()->is('admin*'))
                        <span class="badge badge-admin">Admin</span>
                    @elseif(request()->is('committee*'))
                        <span class="badge badge-committee">Committee</span>
                    @else
                        <span class="badge badge-participant">Participant</span>
                    @endif
                @endauth

                <a href="{{ url('/') }}" class="nav-link">Home</a>
                <a href="{{ url('/events') }}" class="nav-link">Events</a>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ url('/profile') }}" class="nav-link">Profile</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <main class="main-content">
            @if (isset($header))
                <header style="margin-bottom: 2rem;">
                    <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--color-secondary);">
                        {{ $header }}
                    </h1>
                </header>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>
