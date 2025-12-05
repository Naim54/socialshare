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
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: width;
        }
        #sidebar {
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: width;
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .theme-transition {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        .sidebar-text {
            transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1), width 0.35s cubic-bezier(0.4, 0, 0.2, 1), margin 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            will-change: opacity, width, margin;
        }
        .sidebar-collapsed .sidebar-text {
            opacity: 0;
            width: 0;
            margin: 0;
        }
        .sidebar-hover-expanded .sidebar-text {
            opacity: 1;
            width: auto;
            max-width: 200px;
        }
        /* Ensure hover-expanded overrides collapsed when both classes exist */
        .sidebar-collapsed.sidebar-hover-expanded .sidebar-text {
            opacity: 1;
            width: auto;
            max-width: 200px;
        }
        .sidebar-nav-link {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: padding, justify-content;
        }
        .sidebar-collapsed .sidebar-nav-link {
            justify-content: center;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .sidebar-hover-expanded .sidebar-nav-link {
            justify-content: flex-start;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        /* Ensure hover-expanded overrides collapsed for nav links */
        .sidebar-collapsed.sidebar-hover-expanded .sidebar-nav-link {
            justify-content: flex-start;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .sidebar-collapsed .sidebar-nav-link i {
            margin: 0;
            transition: margin 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-hover-expanded .sidebar-nav-link i {
            margin-right: 0.75rem;
        }
        .sidebar-collapsed.sidebar-hover-expanded .sidebar-nav-link i {
            margin-right: 0.75rem;
        }
        #sidebar-toggle i {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
    @stack('styles')
</head>
<body class="font-inter bg-gray-50 dark:bg-dark-900 h-screen theme-transition flex flex-col overflow-hidden">
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white dark:bg-dark-800 shadow-lg sidebar-transition theme-transition flex-shrink-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-4 sm:p-6 h-full flex flex-col">
                <!-- Header with Logo -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 dark:text-indigo-400 flex-shrink-0">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span class="sidebar-text text-xl font-bold text-gray-900 dark:text-white theme-transition tracking-tight">SocialShare</span>
                    </div>
                    <!-- Close button for mobile -->
                    <button id="sidebar-close" class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-dark-700 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="space-y-2 flex-1 overflow-y-auto">
                    @yield('sidebar-nav')
                </nav>

                <!-- Mobile User Menu -->
                <div class="mt-auto lg:hidden border-t border-gray-200 dark:border-dark-700 p-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-sm font-medium">{{ substr(Auth::guard('admin')->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="overflow-hidden">
                            <p class="font-medium text-gray-900 dark:text-white truncate">{{ Auth::guard('admin')->user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::guard('admin')->user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto lg:ml-0">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-50 bg-white dark:bg-dark-800 shadow-sm border-b border-gray-200 dark:border-dark-700 theme-transition flex-shrink-0">
                <div class="flex items-center px-6 py-4 gap-4">
                    <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-all flex-shrink-0" aria-label="Toggle sidebar">
                        <i class="fas fa-angle-left text-lg"></i>
                    </button>
                    <div class="flex-1">
                        @yield('header')
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden bg-gray-50 dark:bg-dark-900 theme-transition">
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

    <!-- Sidebar Collapse Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const toggleIcon = sidebarToggle.querySelector('i');
            let hoverTimeout;
            
            // Get saved state from localStorage
            const savedState = localStorage.getItem('sidebar-collapsed');
            const isCollapsed = savedState === 'true';
            
            // Initialize sidebar state will be handled in resize handler
            
            // Toggle sidebar on button click
            // Toggle sidebar on button click
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isMobile = window.innerWidth < 1024;
                
                if (isMobile) {
                    const isHidden = sidebar.classList.contains('-translate-x-full');
                    if (isHidden) {
                        expandSidebar(true);
                    } else {
                        collapseSidebar(true);
                    }
                } else {
                    const isCurrentlyCollapsed = sidebar.classList.contains('sidebar-collapsed');
                    if (isCurrentlyCollapsed) {
                        expandSidebar(true);
                    } else {
                        collapseSidebar(true);
                    }
                }
            });

            // Close sidebar button (mobile)
            const sidebarClose = document.getElementById('sidebar-close');
            if (sidebarClose) {
                sidebarClose.addEventListener('click', function() {
                    collapseSidebar(true);
                });
            }
            
            // Hover to expand when collapsed (desktop only)
            sidebar.addEventListener('mouseenter', function() {
                const isMobile = window.innerWidth < 1024;
                if (!isMobile && sidebar.classList.contains('sidebar-collapsed')) {
                    clearTimeout(hoverTimeout);
                    // Temporarily expand on hover
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64', 'sidebar-hover-expanded');
                }
            });
            
            sidebar.addEventListener('mouseleave', function() {
                const isMobile = window.innerWidth < 1024;
                if (!isMobile && sidebar.classList.contains('sidebar-collapsed') && sidebar.classList.contains('sidebar-hover-expanded')) {
                    // Collapse back after a short delay for smoother UX
                    hoverTimeout = setTimeout(function() {
                        sidebar.classList.remove('w-64', 'sidebar-hover-expanded');
                        sidebar.classList.add('w-20');
                    }, 50);
                }
            });
            
            function collapseSidebar(saveState = true) {
                const isMobile = window.innerWidth < 1024;
                if (isMobile) {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.add('hidden');
                } else {
                    sidebar.classList.add('sidebar-collapsed');
                    sidebar.classList.remove('w-64', 'sidebar-hover-expanded');
                    sidebar.classList.add('w-20');
                }
                toggleIcon.classList.remove('fa-angle-left');
                toggleIcon.classList.add('fa-angle-right');
                if (saveState) {
                    localStorage.setItem('sidebar-collapsed', 'true');
                }
            }
            
            function expandSidebar(saveState = true) {
                const isMobile = window.innerWidth < 1024;
                if (isMobile) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    // Ensure full width on mobile
                    sidebar.classList.remove('w-20', 'sidebar-collapsed');
                    sidebar.classList.add('w-64');
                    overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.remove('sidebar-collapsed', 'sidebar-hover-expanded');
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                }
                toggleIcon.classList.remove('fa-angle-right');
                toggleIcon.classList.add('fa-angle-left');
                if (saveState) {
                    localStorage.setItem('sidebar-collapsed', 'false');
                }
            }
            
            // Handle mobile overlay click
            const overlay = document.getElementById('sidebar-overlay');
            if (overlay) {
                overlay.addEventListener('click', function() {
                    collapseSidebar();
                });
            }
            
            // Handle window resize
            window.addEventListener('resize', function() {
                const isMobile = window.innerWidth < 1024;
                const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
                
                if (isMobile) {
                    // On mobile, always start collapsed (hidden)
                    if (isCollapsed) {
                        sidebar.classList.add('-translate-x-full');
                        sidebar.classList.remove('translate-x-0');
                        overlay.classList.add('hidden');
                    }
                } else {
                    // On desktop, restore saved state
                    sidebar.classList.remove('-translate-x-full', 'translate-x-0');
                    if (isCollapsed) {
                        collapseSidebar(false);
                    } else {
                        expandSidebar(false);
                    }
                }
            });
            
            // Initialize based on screen size
            const isMobile = window.innerWidth < 1024;
            if (isMobile) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
            } else {
                const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
                if (isCollapsed) {
                    collapseSidebar(false);
                } else {
                    expandSidebar(false);
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

