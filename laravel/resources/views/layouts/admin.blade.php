<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - SocialShare')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .theme-transition {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    </style>
    @stack('styles')
</head>
<body class="font-inter bg-gray-50 dark:bg-dark-900 min-h-screen theme-transition flex flex-col">
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-dark-800 shadow-lg sidebar-transition theme-transition flex-shrink-0">
            <div class="p-6 h-full flex flex-col">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white theme-transition">SocialShare</span>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="space-y-2 flex-1">
                    @yield('sidebar-nav')
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white dark:bg-dark-800 shadow-sm border-b border-gray-200 dark:border-dark-700 theme-transition flex-shrink-0">
                @yield('header')
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-dark-900 theme-transition">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-dark-800 border-t border-gray-200 dark:border-dark-700 theme-transition flex-shrink-0">
                <div class="px-6 py-4">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                        <div class="text-sm text-gray-600 dark:text-gray-400 theme-transition">
                            <p>&copy; {{ date('Y') }} SocialShare. All rights reserved.</p>
                        </div>
                        <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400 theme-transition">
                            <a href="{{ route('welcome') }}" target="_blank" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                View Website
                            </a>
                            <span class="text-gray-300 dark:text-gray-600">|</span>
                            <span>Version 1.0.0</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

