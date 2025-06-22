@props(['title'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Darajat Edu - {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('build/assets/css/main/auth.css') }}" rel="stylesheet">
    
    <!-- Favicon (Generated with Primary color) -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22 fill=%22%2329C3CD%22>🔑</text></svg>">
</head>

<body class="gradient-bg">
    <div class="min-h-screen">
        <!-- Page Content -->
        <main>
            <!-- Platform Name -->
        <div class="brand">
            <span class="gradient-text"><img src="{{asset('build/assets/img/Darajat.png')}}" alt="logo"></span>
        </div>
            {{ $slot}}
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Add floating label animation
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentNode.classList.add('active');
            });
            input.addEventListener('blur', () => {
                if (!input.value) {
                    input.parentNode.classList.remove('active');
                }
            });
        });
        
        // Add smooth transitions
        document.documentElement.style.setProperty('--transition', 'all 0.3s ease');
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>