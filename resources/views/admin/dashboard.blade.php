<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - SocialShare</title>
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
</head>
<body class="font-inter bg-gray-50 dark:bg-dark-900 min-h-screen theme-transition">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white dark:bg-dark-800 shadow-lg sidebar-transition theme-transition">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white theme-transition">SocialShare</span>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg theme-transition">
                        <i class="fas fa-chart-line"></i>
                        <span class="font-medium">Analytics</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-700 rounded-lg theme-transition">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-700 rounded-lg theme-transition">
                        <i class="fas fa-share"></i>
                        <span>Posts</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-700 rounded-lg theme-transition">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white dark:bg-dark-800 shadow-sm border-b border-gray-200 dark:border-dark-700 theme-transition">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white theme-transition">Analytics</h1>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full theme-transition">12 months</button>
                            <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-full theme-transition">30 days</button>
                            <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-full theme-transition">7 days</button>
                            <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-full theme-transition">24 hours</button>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="p-2 text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100 theme-transition">
                            <i id="theme-icon" class="fas fa-moon text-xl"></i>
                        </button>
                        
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-dark-600 bg-white dark:bg-dark-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent theme-transition">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400 dark:text-gray-500"></i>
                        </div>
                        
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100 theme-transition">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- User Menu -->
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">{{ substr(Auth::guard('admin')->user()->name, 0, 1) }}</span>
                            </div>
                            <div class="text-sm">
                                <p class="font-medium text-gray-900 dark:text-white theme-transition">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-gray-500 dark:text-gray-400 theme-transition">{{ Auth::guard('admin')->user()->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="p-2 text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100 theme-transition">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-dark-900 p-6 theme-transition">
                <!-- Key Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 theme-transition">Unique Visitors</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white theme-transition">24.7K</p>
                                <p class="text-sm text-green-600 dark:text-green-400 flex items-center mt-1 theme-transition">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +20% vs last month
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center theme-transition">
                                <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 theme-transition">Total Pageviews</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white theme-transition">55.9K</p>
                                <p class="text-sm text-green-600 dark:text-green-400 flex items-center mt-1 theme-transition">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +4% vs last month
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center theme-transition">
                                <i class="fas fa-eye text-green-600 dark:text-green-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 theme-transition">Bounce Rate</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white theme-transition">54%</p>
                                <p class="text-sm text-red-600 dark:text-red-400 flex items-center mt-1 theme-transition">
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    -1.59% vs last month
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center theme-transition">
                                <i class="fas fa-chart-line text-yellow-600 dark:text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 theme-transition">Visit Duration</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white theme-transition">2m 56s</p>
                                <p class="text-sm text-green-600 dark:text-green-400 flex items-center mt-1 theme-transition">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +7% vs last month
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center theme-transition">
                                <i class="fas fa-clock text-purple-600 dark:text-purple-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Analytics Chart -->
                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Visitor Analytics</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 theme-transition">Last 30 days</p>
                        </div>
                        <div class="chart-container">
                            <canvas id="analyticsChart"></canvas>
                        </div>
                    </div>

                    <!-- Active Users -->
                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Active Users</h3>
                            <button class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 theme-transition">View More</button>
                        </div>
                        <div class="space-y-4">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2 theme-transition">364</div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 theme-transition">Live visitors</p>
                            </div>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white theme-transition">224</div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition">Avg. Daily</p>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white theme-transition">1.4K</div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition">Avg. Weekly</p>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white theme-transition">22.1K</div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition">Avg. Monthly</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Top Channels -->
                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Top Channels</h3>
                            <button class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 theme-transition">View More</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center theme-transition">
                                        <i class="fab fa-google text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white theme-transition">Google</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition">4.7K</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center theme-transition">
                                        <i class="fab fa-facebook text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white theme-transition">Facebook</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition">3.4K</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center theme-transition">
                                        <i class="fab fa-twitter text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white theme-transition">Threads</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition">2.9K</span>
                            </div>
                        </div>
                    </div>

                    <!-- Top Pages -->
                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Top Pages</h3>
                            <button class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 theme-transition">View More</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900 dark:text-white theme-transition">socialshare.com</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition">4.7K</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900 dark:text-white theme-transition">socialshare.com/dashboard</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition">3.4K</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900 dark:text-white theme-transition">socialshare.com/analytics</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition">2.9K</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Recent Activity</h3>
                            <button class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 theme-transition">View All</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white theme-transition">New user registered</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition">2 minutes ago</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white theme-transition">Post published</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition">5 minutes ago</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white theme-transition">Analytics updated</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition">10 minutes ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Theme Toggle Functionality
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        html.classList.toggle('dark', currentTheme === 'dark');
        updateThemeIcon(currentTheme);

        themeToggle.addEventListener('click', () => {
            const isDark = html.classList.toggle('dark');
            const theme = isDark ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
            updateThemeIcon(theme);
            updateChartColors(theme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'fas fa-sun text-xl';
            } else {
                themeIcon.className = 'fas fa-moon text-xl';
            }
        }

        // Analytics Chart
        let analyticsChart;
        const ctx = document.getElementById('analyticsChart').getContext('2d');

        function createChart(theme = 'light') {
            const isDark = theme === 'dark';
            const textColor = isDark ? '#e2e8f0' : '#374151';
            const gridColor = isDark ? '#374151' : '#e5e7eb';

            analyticsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Visitors',
                        data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000, 42000],
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Pageviews',
                        data: [18000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000, 45000, 42000, 48000],
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: textColor
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: textColor
                            },
                            grid: {
                                color: gridColor
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: textColor
                            },
                            grid: {
                                color: gridColor
                            }
                        }
                    }
                }
            });
        }

        function updateChartColors(theme) {
            if (analyticsChart) {
                const isDark = theme === 'dark';
                const textColor = isDark ? '#e2e8f0' : '#374151';
                const gridColor = isDark ? '#374151' : '#e5e7eb';

                analyticsChart.options.plugins.legend.labels.color = textColor;
                analyticsChart.options.scales.x.ticks.color = textColor;
                analyticsChart.options.scales.x.grid.color = gridColor;
                analyticsChart.options.scales.y.ticks.color = textColor;
                analyticsChart.options.scales.y.grid.color = gridColor;
                analyticsChart.update();
            }
        }

        // Initialize chart with current theme
        createChart(currentTheme);
    </script>
</body>
</html>
