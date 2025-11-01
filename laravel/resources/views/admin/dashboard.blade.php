@extends('layouts.admin')

@section('title', 'Social Share Analytics - SocialShare')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg theme-transition">
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
@endsection

@section('header')
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white theme-transition">Admin Dashboard</h2>
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
@endsection

@section('content')
    <div class="p-6">
        <!-- Page Header with Title and Filters -->
        <div class="mb-6 pb-4 border-b border-gray-200 dark:border-dark-700 theme-transition">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white theme-transition mb-2">Social Share Analytics</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 theme-transition">Track and analyze social media share performance</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex space-x-2">
                        <button data-period="30" class="period-btn px-3 py-1 text-sm bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full theme-transition">30 days</button>
                        <button data-period="7" class="period-btn px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-full theme-transition">7 days</button>
                        <button data-period="24" class="period-btn px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-full theme-transition">24 hours</button>
                    </div>
                    <select id="platform-filter" class="px-3 py-1 text-sm border border-gray-300 dark:border-dark-600 bg-white dark:bg-dark-700 text-gray-900 dark:text-white rounded-lg theme-transition">
                        <option value="all">All Platforms</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="telegram">Telegram</option>
                        <option value="email">Email</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="hidden mb-4 text-center">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Loading analytics...</p>
        </div>

        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8" id="metrics-container">
            <!-- Total Clicks -->
            <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 theme-transition">Total Shares</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white theme-transition" id="total-clicks">0</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center theme-transition">
                        <i class="fas fa-share-alt text-indigo-600 dark:text-indigo-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Platform-specific metrics will be populated by JavaScript -->
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Shares Over Time Chart -->
            <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Shares Over Time</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 theme-transition" id="time-range-text">Last 30 days</p>
                </div>
                <!-- Statistics Summary -->
                <div id="chart-stats" class="grid grid-cols-3 gap-4 mb-4 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg theme-transition" style="display: none;">
                    <div class="text-center">
                        <div class="text-xs text-gray-500 dark:text-gray-400 theme-transition mb-1">Peak</div>
                        <div class="text-sm font-bold text-green-600 dark:text-green-400 theme-transition" id="stat-max">0</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xs text-gray-500 dark:text-gray-400 theme-transition mb-1">Average</div>
                        <div class="text-sm font-bold text-blue-600 dark:text-blue-400 theme-transition" id="stat-avg">0</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xs text-gray-500 dark:text-gray-400 theme-transition mb-1">Lowest</div>
                        <div class="text-sm font-bold text-gray-600 dark:text-gray-400 theme-transition" id="stat-min">0</div>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="sharesOverTimeChart"></canvas>
                </div>
            </div>

            <!-- Platform Distribution -->
            <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Platform Distribution</h3>
                </div>
                <div class="chart-container">
                    <canvas id="platformDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Pages -->
            <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Top Shared Pages</h3>
                </div>
                <div class="space-y-4" id="top-pages-list">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>

            <!-- Platform Stats -->
            <div class="bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white theme-transition">Platform Statistics</h3>
                </div>
                <div class="space-y-4" id="platform-stats-list">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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

    // Social Share Analytics
    let sharesOverTimeChart = null;
    let platformDistributionChart = null;
    let currentPeriod = 30; // days
    let currentPlatform = 'all';

    const platformColors = {
        facebook: { bg: 'rgb(59, 130, 246)', hover: 'rgba(59, 130, 246, 0.8)' },
        twitter: { bg: 'rgb(0, 0, 0)', hover: 'rgba(0, 0, 0, 0.8)' },
        whatsapp: { bg: 'rgb(34, 197, 94)', hover: 'rgba(34, 197, 94, 0.8)' },
        telegram: { bg: 'rgb(59, 130, 246)', hover: 'rgba(59, 130, 246, 0.8)' },
        email: { bg: 'rgb(107, 114, 128)', hover: 'rgba(107, 114, 128, 0.8)' }
    };

    const platformIcons = {
        facebook: 'fab fa-facebook',
        twitter: 'fab fa-twitter',
        whatsapp: 'fab fa-whatsapp',
        telegram: 'fab fa-telegram',
        email: 'fas fa-envelope'
    };

    function getDateRange(period) {
        const endDate = new Date();
        const startDate = new Date();
        
        if (period === 24) {
            startDate.setHours(endDate.getHours() - 24);
        } else {
            startDate.setDate(endDate.getDate() - period);
        }
        
        return {
            start: startDate.toISOString().split('T')[0],
            end: endDate.toISOString().split('T')[0]
        };
    }

    async function loadAnalytics() {
        const loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.classList.remove('hidden');

        try {
            const dateRange = getDateRange(currentPeriod);
            const params = new URLSearchParams({
                start_date: dateRange.start,
                end_date: dateRange.end
            });

            if (currentPlatform !== 'all') {
                params.append('platform', currentPlatform);
            }

            const response = await fetch(`/admin/api/social-share/analytics?${params.toString()}`);
            const result = await response.json();

            if (result.success) {
                updateDashboard(result.data);
            } else {
                console.error('Failed to load analytics:', result);
            }
        } catch (error) {
            console.error('Error loading analytics:', error);
        } finally {
            loadingIndicator.classList.add('hidden');
        }
    }

    function updateDashboard(data) {
        // Update total clicks
        document.getElementById('total-clicks').textContent = data.total_clicks.toLocaleString();

        // Update platform metrics
        updatePlatformMetrics(data.clicks_by_platform);

        // Update charts
        updateSharesOverTimeChart(data.clicks_over_time);
        updatePlatformDistributionChart(data.clicks_by_platform);

        // Update top pages
        updateTopPages(data.top_pages);

        // Update platform stats
        updatePlatformStats(data.platform_stats);
    }

    function updatePlatformMetrics(clicksByPlatform) {
        const container = document.getElementById('metrics-container');
        const existingMetrics = container.querySelectorAll('.platform-metric');
        existingMetrics.forEach(el => el.remove());

        Object.entries(clicksByPlatform).forEach(([platform, count]) => {
            const color = platformColors[platform] || { bg: 'rgb(99, 102, 241)' };
            const icon = platformIcons[platform] || 'fas fa-share-alt';
            const platformName = platform.charAt(0).toUpperCase() + platform.slice(1);

            const metricCard = document.createElement('div');
            metricCard.className = 'bg-white dark:bg-dark-800 rounded-xl shadow-sm p-6 theme-transition platform-metric';
            metricCard.innerHTML = `
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 theme-transition">${platformName}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white theme-transition">${count.toLocaleString()}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center theme-transition" style="background-color: ${color.hover}20;">
                        <i class="${icon}" style="color: ${color.bg};"></i>
                    </div>
                </div>
            `;
            container.appendChild(metricCard);
        });
    }

    function updateSharesOverTimeChart(data) {
        const ctx = document.getElementById('sharesOverTimeChart');
        const isDark = html.classList.contains('dark');
        const textColor = isDark ? '#e2e8f0' : '#374151';
        const gridColor = isDark ? '#374151' : '#e5e7eb';
        const borderColor = isDark ? 'rgba(139, 92, 246, 0.3)' : 'rgba(139, 92, 246, 0.2)';

        if (sharesOverTimeChart) {
            sharesOverTimeChart.destroy();
        }

        if (data.length === 0) {
            ctx.getContext('2d').clearRect(0, 0, ctx.width, ctx.height);
            return;
        }

        const labels = data.map(item => item.period);
        const values = data.map(item => item.count);
        
        // Calculate statistics
        const maxValue = Math.max(...values);
        const minValue = Math.min(...values);
        const avgValue = Math.round(values.reduce((a, b) => a + b, 0) / values.length);
        
        // Update statistics display
        const statsDiv = document.getElementById('chart-stats');
        if (statsDiv) {
            document.getElementById('stat-max').textContent = maxValue.toLocaleString();
            document.getElementById('stat-avg').textContent = avgValue.toLocaleString();
            document.getElementById('stat-min').textContent = minValue.toLocaleString();
            statsDiv.style.display = 'grid';
        }

        sharesOverTimeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Social Shares',
                    data: values,
                    borderColor: 'rgb(139, 92, 246)',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 3,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: 'rgb(139, 92, 246)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(139, 92, 246)',
                    pointHoverBorderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    stepped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: textColor,
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(30, 41, 59, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: 'rgb(139, 92, 246)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                return `${context.dataset.label}: ${context.parsed.y.toLocaleString()} shares`;
                            },
                            afterLabel: function(context) {
                                const value = context.parsed.y;
                                let comparison = '';
                                if (value === maxValue) {
                                    comparison = ' (Peak)';
                                } else if (value === minValue) {
                                    comparison = ' (Lowest)';
                                } else if (value > avgValue) {
                                    comparison = ` (Above avg: ${avgValue})`;
                                } else {
                                    comparison = ` (Below avg: ${avgValue})`;
                                }
                                return comparison;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: textColor,
                            maxRotation: 45,
                            minRotation: 45,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: borderColor,
                            drawBorder: true,
                            borderColor: gridColor
                        },
                        title: {
                            display: true,
                            text: 'Time Period',
                            color: textColor,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: textColor,
                            stepSize: 1,
                            callback: function(value) {
                                return value.toLocaleString();
                            },
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: borderColor,
                            drawBorder: true,
                            borderColor: gridColor
                        },
                        title: {
                            display: true,
                            text: 'Number of Shares',
                            color: textColor,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    }

    function updatePlatformDistributionChart(data) {
        const ctx = document.getElementById('platformDistributionChart');
        const isDark = html.classList.contains('dark');
        const textColor = isDark ? '#e2e8f0' : '#374151';

        if (platformDistributionChart) {
            platformDistributionChart.destroy();
        }

        const labels = Object.keys(data).map(p => p.charAt(0).toUpperCase() + p.slice(1));
        const values = Object.values(data);
        const colors = Object.keys(data).map(p => platformColors[p]?.bg || 'rgb(99, 102, 241)');

        platformDistributionChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors.map(c => c.replace('rgb', 'rgba').replace(')', ', 0.8)')),
                    borderColor: colors,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            padding: 15
                        }
                    }
                }
            }
        });
    }

    function updateTopPages(pages) {
        const container = document.getElementById('top-pages-list');
        container.innerHTML = '';

        if (pages.length === 0) {
            container.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">No data available</p>';
            return;
        }

        pages.forEach((page, index) => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between';
            item.innerHTML = `
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white theme-transition truncate" title="${page.url}">
                        ${index + 1}. ${page.title || page.url}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 theme-transition truncate">${page.url}</p>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400 theme-transition ml-4">${page.count.toLocaleString()}</span>
            `;
            container.appendChild(item);
        });
    }

    function updatePlatformStats(stats) {
        const container = document.getElementById('platform-stats-list');
        container.innerHTML = '';

        Object.entries(stats).forEach(([platform, stat]) => {
            const color = platformColors[platform] || { bg: 'rgb(99, 102, 241)' };
            const icon = platformIcons[platform] || 'fas fa-share-alt';
            const platformName = platform.charAt(0).toUpperCase() + platform.slice(1);

            const item = document.createElement('div');
            item.className = 'flex items-center justify-between';
            item.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center theme-transition" style="background-color: ${color.hover}20;">
                        <i class="${icon}" style="color: ${color.bg};"></i>
                    </div>
                    <span class="font-medium text-gray-900 dark:text-white theme-transition">${platformName}</span>
                </div>
                <div class="text-right">
                    <span class="text-sm font-bold text-gray-900 dark:text-white theme-transition">${stat.total.toLocaleString()}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 theme-transition ml-2">${stat.percentage.toFixed(1)}%</span>
                </div>
            `;
            container.appendChild(item);
        });
    }

    function updateChartColors(theme) {
        if (sharesOverTimeChart) {
            const isDark = theme === 'dark';
            const textColor = isDark ? '#e2e8f0' : '#374151';
            const gridColor = isDark ? '#374151' : '#e5e7eb';

            sharesOverTimeChart.options.plugins.legend.labels.color = textColor;
            sharesOverTimeChart.options.scales.x.ticks.color = textColor;
            sharesOverTimeChart.options.scales.x.grid.color = gridColor;
            sharesOverTimeChart.options.scales.y.ticks.color = textColor;
            sharesOverTimeChart.options.scales.y.grid.color = gridColor;
            sharesOverTimeChart.update();
        }

        if (platformDistributionChart) {
            const isDark = theme === 'dark';
            const textColor = isDark ? '#e2e8f0' : '#374151';
            platformDistributionChart.options.plugins.legend.labels.color = textColor;
            platformDistributionChart.update();
        }
    }

    // Period buttons
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.period-btn').forEach(b => {
                b.classList.remove('bg-indigo-100', 'dark:bg-indigo-900/30', 'text-indigo-700', 'dark:text-indigo-300');
                b.classList.add('text-gray-500', 'dark:text-gray-400');
            });
            this.classList.add('bg-indigo-100', 'dark:bg-indigo-900/30', 'text-indigo-700', 'dark:text-indigo-300');
            this.classList.remove('text-gray-500', 'dark:text-gray-400');
            
            currentPeriod = parseInt(this.dataset.period);
            
            // Update time range text
            const timeRangeText = document.getElementById('time-range-text');
            if (currentPeriod === 24) {
                timeRangeText.textContent = 'Last 24 hours';
            } else if (currentPeriod === 7) {
                timeRangeText.textContent = 'Last 7 days';
            } else {
                timeRangeText.textContent = 'Last 30 days';
            }
            
            loadAnalytics();
        });
    });

    // Platform filter
    document.getElementById('platform-filter').addEventListener('change', function() {
        currentPlatform = this.value;
        loadAnalytics();
    });

    // Load analytics on page load
    loadAnalytics();
</script>
@endpush
