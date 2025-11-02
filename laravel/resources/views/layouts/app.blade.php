<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SocialShare - Your News, Your Way')</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col @yield('body-class', 'h-screen') bg-base-100 text-base-content">

    @include('partials.navbar')

    <!-- Main Content Area -->
    <div class="flex flex-1 @yield('content-wrapper-class', 'overflow-hidden')">
        
        @yield('sidebar')
        
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto @yield('main-class', 'p-6 bg-base-100') pb-16 md:pb-20">
            <div class="max-w-[1200px] mx-auto px-6 md:px-8 lg:px-10">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
    
    <script>
        // Sidebar Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', () => {
                if (sidebar.classList.contains('w-64')) {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                } else {
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                }
            });
        }

        // Theme Toggle with DaisyUI - Initialize from saved preference
        document.addEventListener('DOMContentLoaded', () => {
            const html = document.documentElement;
            const themeToggle = document.getElementById('theme-toggle');
            
            // Get saved theme or default to dark
            const savedTheme = localStorage.getItem('theme') || 'dark';
            html.setAttribute('data-theme', savedTheme);
            
            // Set checkbox state based on saved theme (checked = light, unchecked = dark)
            if (themeToggle) {
                themeToggle.checked = savedTheme === 'light';
                
                // Listen for theme toggle changes
                themeToggle.addEventListener('change', (e) => {
                    const newTheme = e.target.checked ? 'light' : 'dark';
                    html.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                });
            }
        });
    </script>
</body>
</html>