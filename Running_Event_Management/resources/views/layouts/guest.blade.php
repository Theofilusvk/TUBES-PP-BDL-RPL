<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ config('app.name', 'LariKalcer') }} - @yield('title', 'Sign In')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#2563EB", // Vibrant Royal Blue
                        secondary: "#3B82F6",
                        accent: "#F59E0B",
                        "background-light": "#F3F4F6",
                        "background-dark": "#111827",
                        "surface-light": "#FFFFFF",
                        "surface-dark": "#1F2937",
                        "text-light": "#1F2937",
                        "text-dark": "#F9FAFB",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': '1rem',
                        '2xl': '1.5rem',
                    },
                },
            },
        };
    </script>
    <style>.runner-bg {
        background-image: url(https://lh3.googleusercontent.com/aida-public/AB6AXuBiATvqdVwj0xk_ZsksH1pP0CkAXKjrlhvh3ZfLo2cZ3IhDGC8O35yyMk5Hp6zbBN0lpIk5juk9J_Q-yasPNhK9MUk43fhK_ecf4rzuIZakTWgURDAyJZ3ynUfIa3936595pOI2Lxv8Cm6Y0NTaojsQw8HPXi8q4InX3-dGo-ombdJEZS0JnCzMbRBSi8ftYMIONG7qIb7IMi_BEizW73RT3H2qn9ivYqml_hlss8ba2Lqk0JEzqs1kCSFi-fqWCGyuWZzqpfHBlFs);
        background-size: cover;
        background-position: center
        }
    .gradient-overlay {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.9) 0%, rgba(30, 64, 175, 0.8) 100%)
        }::-webkit-scrollbar {
        width: 8px
        }
    ::-webkit-scrollbar-track {
        background: transparent
        }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px
        }
    .dark ::-webkit-scrollbar-thumb {
        background: #4b5563
        }</style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark antialiased transition-colors duration-300 h-screen flex overflow-hidden">
    @yield('content')
</body>
</html>
