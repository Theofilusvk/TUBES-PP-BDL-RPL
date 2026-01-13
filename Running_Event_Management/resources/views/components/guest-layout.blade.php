<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Running Event Management') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            background-color: var(--color-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .guest-card {
            background-color: var(--color-white);
            padding: 2.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        .brand-logo {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 800;
            color: var(--color-secondary);
        }
    </style>
</head>
<body>
    <div class="guest-card">
        <div class="brand-logo">
            <span class="text-primary">RUN</span>Event
        </div>
        {{ $slot }}
    </div>
</body>
</html>
