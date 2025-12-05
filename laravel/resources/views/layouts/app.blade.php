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

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 md:hidden hidden transition-opacity duration-300"></div>

    <!-- Main Content Area -->
    <div class="flex flex-1 @yield('content-wrapper-class', 'overflow-hidden')">
        
        @yield('sidebar')
        
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto @yield('main-class', 'p-4 md:p-6 bg-base-100') pb-16 md:pb-20 w-full md:w-auto">
            <div class="max-w-[1200px] mx-auto w-full px-4 sm:px-6 md:px-8 lg:px-10">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
    
    <style>
        /* Mobile sidebar styles - ensure it overlays and doesn't affect content */
        @media (max-width: 767px) {
            /* Sidebar should be completely removed from document flow on mobile */
            #sidebar {
                position: fixed !important;
                top: 4rem !important; /* Below navbar */
                left: 0 !important;
                z-index: 40 !important;
                width: 85% !important;
                max-width: 320px !important;
                height: calc(100vh - 4rem) !important;
                transform: translateX(-100%) !important; /* Hidden by default */
                transition: transform 0.3s ease-in-out !important;
            }
            
            /* When sidebar is visible on mobile - ensure it's fully expanded */
            #sidebar.mobile-open {
                transform: translateX(0) !important;
                width: 85% !important;
                max-width: 320px !important;
            }
            
            /* Override collapsed styles on mobile when open - show all text and content */
            #sidebar.mobile-open.sidebar-collapsed,
            #sidebar.mobile-open {
                width: 85% !important;
                max-width: 320px !important;
            }
            
            #sidebar.mobile-open .sidebar-text {
                opacity: 1 !important;
                width: auto !important;
                margin: 0 !important;
                display: inline !important;
                overflow: visible !important;
            }
            
            #sidebar.mobile-open .sidebar-link {
                justify-content: flex-start !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
                gap: 0.75rem !important;
            }
            
            #sidebar.mobile-open .sidebar-divider,
            #sidebar.mobile-open .sidebar-title {
                opacity: 1 !important;
                height: auto !important;
                margin: 0 !important;
                padding: 0.5rem 1rem !important;
                display: block !important;
                overflow: visible !important;
            }
            
            #sidebar.mobile-open .sidebar-divider .divider {
                opacity: 0.3 !important;
                display: block !important;
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            /* Ensure sidebar is always in document flow on mobile (not display:none) */
            #sidebar.hidden {
                display: block !important;
                transform: translateX(-100%) !important;
            }
            
            /* Ensure main content always takes full width on mobile */
            main {
                width: 100% !important;
                max-width: 100% !important;
                margin-left: 0 !important;
                flex: 1 1 100% !important;
            }
            
            /* Content wrapper should not be affected by sidebar on mobile */
            .flex.flex-1 {
                width: 100% !important;
            }
        }
        
        /* Sidebar collapsed state styles */
        #sidebar.sidebar-collapsed {
            width: 5rem !important; /* w-20 */
        }
        
        #sidebar.sidebar-collapsed .sidebar-text {
            opacity: 0 !important;
            width: 0 !important;
            margin: 0 !important;
            overflow: hidden;
            display: none;
        }
        
        #sidebar.sidebar-collapsed .sidebar-link {
            justify-content: center !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            gap: 0 !important;
        }
        
        #sidebar.sidebar-collapsed .sidebar-divider,
        #sidebar.sidebar-collapsed .sidebar-title {
            opacity: 0 !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
            display: none;
        }
        
        /* Keep active state visible when collapsed - use darker grey color with border */
        #sidebar.sidebar-collapsed .sidebar-link.active {
            background-color: hsl(var(--bc) / 0.5) !important; /* darker grey with 50% opacity */
            color: hsl(var(--bc)) !important; /* base-content for text */
            border-left: 4px solid hsl(var(--p)) !important; /* primary color border */
            font-weight: 600 !important; /* semibold */
        }
        
        /* Active state in expanded mode should also be very visible */
        #sidebar .sidebar-link.active {
            border-left: 4px solid hsl(var(--p)) !important; /* primary color border */
        }
        
        /* Hover expanded state - override collapsed styles */
        #sidebar.sidebar-collapsed.sidebar-hover-expanded {
            width: 16rem !important; /* w-64 */
        }
        
        #sidebar.sidebar-collapsed.sidebar-hover-expanded .sidebar-text {
            opacity: 1 !important;
            width: auto !important;
            margin: 0 !important;
            display: inline !important;
        }
        
        #sidebar.sidebar-collapsed.sidebar-hover-expanded .sidebar-link {
            justify-content: flex-start !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            gap: 0.75rem !important;
        }
        
        #sidebar.sidebar-collapsed.sidebar-hover-expanded .sidebar-divider {
            opacity: 1 !important;
            height: auto !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
            padding: 0 !important;
            display: block !important;
        }
        
        #sidebar.sidebar-collapsed.sidebar-hover-expanded .sidebar-divider .divider {
            opacity: 0.3;
            display: block !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }
        
        #sidebar.sidebar-collapsed.sidebar-hover-expanded .sidebar-title {
            opacity: 1 !important;
            height: auto !important;
            margin-top: 0.25rem !important;
            margin-bottom: 0.25rem !important;
            padding: 0.5rem 1rem !important;
            display: block !important;
        }
    </style>
    
    <script>
        // Sidebar Toggle for Mobile and Desktop with Hover Expand
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            let hoverTimeout;

            if (!menuToggle || !sidebar) return;
            // Get saved collapsed state from localStorage
            const savedState = localStorage.getItem('sidebar-collapsed');
            const isCollapsed = savedState === 'true';
            
            // Initialize sidebar state on desktop
            const initializeSidebar = () => {
                if (window.innerWidth >= 768) {
                    if (isCollapsed) {
                        sidebar.classList.add('sidebar-collapsed');
                        sidebar.classList.remove('w-64');
                        sidebar.classList.add('w-20');
                    } else {
                        sidebar.classList.remove('sidebar-collapsed');
                        sidebar.classList.remove('w-20');
                        sidebar.classList.add('w-64');
                    }
                }
            };
            
            // Initialize on page load
            if (window.innerWidth < 768) {
                // Mobile: ensure sidebar starts hidden and remove any collapsed classes
                sidebar.classList.add('hidden');
                sidebar.classList.remove('mobile-open', 'sidebar-collapsed', 'sidebar-hover-expanded', 'w-20');
                sidebar.classList.add('w-64');
                if (overlay) overlay.classList.add('hidden');
            } else {
                initializeSidebar();
            }
            
            // Handle window resize
            const handleResize = () => {
                if (window.innerWidth >= 768) {
                    // Desktop: ensure sidebar is visible and restore state
                    sidebar.classList.remove('hidden', 'mobile-open', 'sidebar-hover-expanded');
                    if (overlay) overlay.classList.add('hidden');
                    initializeSidebar();
                } else {
                    // Mobile: ensure sidebar is hidden by default and remove collapsed classes
                    sidebar.classList.remove('sidebar-collapsed', 'sidebar-hover-expanded', 'w-20');
                    if (sidebar.classList.contains('mobile-open')) {
                        sidebar.classList.remove('mobile-open');
                        sidebar.classList.add('hidden');
                        if (overlay) overlay.classList.add('hidden');
                    }
                }
            };
            
            window.addEventListener('resize', handleResize);
            
            // Hover to expand when collapsed (desktop only)
            sidebar.addEventListener('mouseenter', () => {
                if (window.innerWidth >= 768 && sidebar.classList.contains('sidebar-collapsed')) {
                    clearTimeout(hoverTimeout);
                    sidebar.classList.add('sidebar-hover-expanded');
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                }
            });
            
            sidebar.addEventListener('mouseleave', () => {
                if (window.innerWidth >= 768 && sidebar.classList.contains('sidebar-collapsed')) {
                    hoverTimeout = setTimeout(() => {
                        sidebar.classList.remove('sidebar-hover-expanded', 'w-64');
                        sidebar.classList.add('w-20');
                    }, 100);
                }
            });
            
            menuToggle.addEventListener('click', () => {
                // On mobile: toggle visibility
                if (window.innerWidth < 768) {
                    const isOpen = sidebar.classList.contains('mobile-open');
                    if (isOpen) {
                        // Hide sidebar
                        sidebar.classList.remove('mobile-open');
                        sidebar.classList.add('hidden');
                        if (overlay) overlay.classList.add('hidden');
                    } else {
                        // Show sidebar - ensure it's fully expanded on mobile
                        sidebar.classList.remove('hidden', 'sidebar-collapsed', 'sidebar-hover-expanded', 'w-20');
                        sidebar.classList.add('mobile-open', 'w-64');
                        if (overlay) overlay.classList.remove('hidden');
                    }
                } else {
                    // On desktop: toggle collapsed state
                    if (sidebar.classList.contains('sidebar-collapsed')) {
                        // Expand
                        sidebar.classList.remove('sidebar-collapsed', 'sidebar-hover-expanded', 'w-20');
                        sidebar.classList.add('w-64');
                        localStorage.setItem('sidebar-collapsed', 'false');
                    } else {
                        // Collapse
                        sidebar.classList.add('sidebar-collapsed');
                        sidebar.classList.remove('sidebar-hover-expanded', 'w-64');
                        sidebar.classList.add('w-20');
                        localStorage.setItem('sidebar-collapsed', 'true');
                    }
                }
            });
            
            // Close mobile sidebar when clicking outside or on overlay
            if (overlay) {
                overlay.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('mobile-open');
                        sidebar.classList.add('hidden');
                        overlay.classList.add('hidden');
                    }
                });
            }
            
            document.addEventListener('click', (e) => {
                if (window.innerWidth < 768) {
                    if (!sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('mobile-open')) {
                        sidebar.classList.remove('mobile-open');
                        sidebar.classList.add('hidden');
                        if (overlay) overlay.classList.add('hidden');
                    }
                }
            });
        });

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


