 @extends('layouts.admin')

@section('title', 'Dashboard - SocialShare')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link flex items-center space-x-3 px-4 py-3 text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg theme-transition">
        <i class="fas fa-share-alt flex-shrink-0"></i>
        <span class="sidebar-text font-medium">Dashboard</span>
    </a>
@endsection

@section('header')
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white theme-transition">Dashboard</h2>
        </div>
        
        <div class="flex items-center space-x-4">
            <button id="theme-toggle" class="p-2 text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100 theme-transition">
                <i id="theme-icon" class="fas fa-moon text-xl"></i>
            </button>
            <div class="hidden lg:flex items-center space-x-3">
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
    <div class="p-6 md:px-12 lg:px-20 xl:px-32 2xl:px-40">
        <!-- Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Unique Visitors Card -->
            <div class="card bg-gradient-to-br from-base-100 to-primary/5 dark:from-dark-800 dark:to-primary/10 shadow-xl hover:shadow-2xl transition-all duration-300 border-l-4 border-primary overflow-hidden group hover:-translate-y-1">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="avatar placeholder">
                                <div class="bg-primary/20 text-primary rounded-xl w-14 h-14 flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-base-content/60 dark:text-white/80 uppercase tracking-wide">Unique Visitors</h3>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-2">
                <div>
                            <p class="text-4xl font-extrabold text-base-content dark:text-white leading-tight">
                                {{ number_format($metrics['unique_visitors']['value']) }}
                            </p>
                </div>
                    </div>
                </div>
            </div>

            <!-- Device Types Card -->
            <div class="card bg-gradient-to-br from-base-100 to-secondary/5 dark:from-dark-800 dark:to-secondary/10 shadow-xl hover:shadow-2xl transition-all duration-300 border-l-4 border-secondary overflow-hidden group hover:-translate-y-1">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="avatar placeholder">
                                <div class="bg-secondary/20 text-secondary rounded-xl w-14 h-14 flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <i class="fas fa-mobile-alt text-2xl"></i>
        </div>
        </div>
                    <div>
                                <h3 class="text-sm font-semibold text-base-content/60 dark:text-white/80 uppercase tracking-wide">Device Types</h3>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-2">
                        <div>
                            <p class="text-4xl font-extrabold text-base-content dark:text-white leading-tight">
                                {{ $metrics['device_types']['value'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Shares Card -->
            <div class="card bg-gradient-to-br from-base-100 to-accent/5 dark:from-dark-800 dark:to-accent/10 shadow-xl hover:shadow-2xl transition-all duration-300 border-l-4 border-accent overflow-hidden group hover:-translate-y-1">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="avatar placeholder">
                                <div class="bg-accent/20 text-accent rounded-xl w-14 h-14 flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <i class="fas fa-share-alt text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-base-content/60 dark:text-white/80 uppercase tracking-wide">Total Shares</h3>
        </div>
                </div>
                    </div>
                    <div class="flex items-end justify-between mt-2">
                        <div>
                            <p class="text-4xl font-extrabold text-base-content dark:text-white leading-tight">
                                {{ number_format($metrics['total_shares']['value']) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Articles Card -->
            <div class="card bg-gradient-to-br from-base-100 to-info/5 dark:from-dark-800 dark:to-info/10 shadow-xl hover:shadow-2xl transition-all duration-300 border-l-4 border-info overflow-hidden group hover:-translate-y-1">
                <div class="card-body p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="avatar placeholder">
                                <div class="bg-info/20 text-info rounded-xl w-14 h-14 flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <i class="fas fa-newspaper text-2xl"></i>
                                </div>
                </div>
                            <div>
                                <h3 class="text-sm font-semibold text-base-content/60 dark:text-white/80 uppercase tracking-wide">Total Articles</h3>
                </div>
            </div>
        </div>
                    <div class="flex items-end justify-between mt-2">
                        <div>
                            <p class="text-4xl font-extrabold text-base-content dark:text-white leading-tight">
                                {{ number_format($metrics['total_articles']['value']) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Shares Trend Chart (Last 30 Days) -->
            <div class="lg:col-span-2 card bg-white dark:bg-dark-800 shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Shares Trend</h3>
                            </div>
                            <select id="sharesTrendRange" class="select select-bordered select-sm text-xs bg-white dark:bg-dark-700 border-gray-300 dark:border-dark-600 text-gray-700 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-400">
                                <option value="7" {{ ($dateRange ?? '7') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                                <option value="30" {{ ($dateRange ?? '7') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                            </select>
                        </div>
                        <div class="dropdown dropdown-end">
                            <button class="btn btn-ghost btn-sm btn-circle" tabindex="0">
                                <i class="fas fa-ellipsis-v text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100"></i>
                            </button>
                            <ul class="dropdown-content menu bg-white dark:bg-dark-700 rounded-box z-[1] w-52 p-2 shadow-lg border border-gray-200 dark:border-dark-600">
                                <li>
                                    <a href="{{ route('admin.export.shares-trend') }}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                        <span>Export Excel</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="exportChartAsImage('sharesTrendChart', 'shares-trend'); return false;" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-image text-blue-600 dark:text-blue-400"></i>
                                        <span>Export Image</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-6 mb-4">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Shares</p>
                            <p id="sharesTrendTotal" class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($sharesTrendData['total_shares']) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Avg Daily</p>
                            <p id="sharesTrendAvg" class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($sharesTrendData['avg_daily']) }}</p>
                        </div>
                    </div>
                    
                    <div class="chart-container" style="height: 280px;">
                        <canvas id="sharesTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Shares Metric Card with Mini Chart -->
            <div class="card bg-white dark:bg-dark-800 shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="card-body p-6">
                <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-lg bg-teal-500/10 dark:bg-teal-500/20 text-teal-500 dark:text-teal-400 flex items-center justify-center">
                                <i class="fas fa-share-alt text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Shares</h3>
                                    <select id="sharesPlatformRange" class="select select-bordered select-sm text-[10px] bg-white dark:bg-dark-700 border-gray-300 dark:border-dark-600 text-gray-700 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-400">
                                        <option value="7" {{ ($dateRange ?? '7') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                                        <option value="30" {{ ($dateRange ?? '7') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dropdown-end">
                            <button class="btn btn-ghost btn-sm btn-circle" tabindex="0">
                                <i class="fas fa-ellipsis-v text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100"></i>
                            </button>
                            <ul class="dropdown-content menu bg-white dark:bg-dark-700 rounded-box z-[1] w-52 p-2 shadow-lg border border-gray-200 dark:border-dark-600">
                                <li>
                                    <a href="{{ route('admin.export.shares-platform') }}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                        <span>Export Excel</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="exportChartAsImage('dailySharesChart', 'shares-by-platform'); return false;" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-image text-blue-600 dark:text-blue-400"></i>
                                        <span>Export Image</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p id="sharesPlatformTotal" class="text-4xl font-bold text-gray-900 dark:text-white mb-4 text-center">{{ number_format($metrics['total_shares']['value']) }}</p>
                    </div>
                    
                    <!-- Donut Chart - Centered and Bigger -->
                    <div class="flex justify-center mb-4">
                        <div class="chart-container" style="height: 200px; width: 200px; position: relative;">
                            <canvas id="dailySharesChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Platform Legend -->
                    <div id="sharesPlatformLegend" class="grid grid-cols-2 gap-x-4 gap-y-2.5 pt-4 border-t border-gray-100 dark:border-gray-700">
                        @foreach($sharesByPlatform['labels'] as $index => $label)
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: {{ $sharesByPlatform['colors'][$index] }}"></div>
                                <span class="text-xs font-medium text-gray-600 dark:text-gray-400 truncate">{{ $label }}</span>
                            </div>
                        @endforeach
                </div>
                </div>
            </div>
        </div>

        <!-- Second Row Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Top Categories Shared List -->
            <div class="card bg-white dark:bg-dark-800 shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Top Categories</h3>
                            </div>
                            <select id="topCategoriesRange" class="select select-bordered select-sm text-xs bg-white dark:bg-dark-700 border-gray-300 dark:border-dark-600 text-gray-700 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-400">
                                <option value="7" {{ ($dateRange ?? '7') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                                <option value="30" {{ ($dateRange ?? '7') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                            </select>
                        </div>
                        <div class="dropdown dropdown-end">
                            <button class="btn btn-ghost btn-sm btn-circle" tabindex="0">
                                <i class="fas fa-ellipsis-v text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100"></i>
                            </button>
                            <ul class="dropdown-content menu bg-white dark:bg-dark-700 rounded-box z-[1] w-52 p-2 shadow-lg border border-gray-200 dark:border-dark-600">
                                <li>
                                    <a href="{{ route('admin.export.top-categories') }}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                        <span>Export Excel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="topCategoriesList" class="space-y-3">
                        @foreach($topCategoriesShared as $category)
                            <div class="flex items-center gap-4 py-2">
                                <!-- Icon -->
                                <div class="w-12 h-12 rounded-lg {{ $category['color'] }} flex items-center justify-center flex-shrink-0">
                                    <i class="fas {{ $category['icon'] }} text-white text-lg"></i>
                                </div>
                                
                                <!-- Labels -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $category['name'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $category['description'] }}</p>
                                </div>
                                
                                <!-- Shares -->
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($category['shares']) }}</p>
                                </div>
                            </div>
                        @endforeach
                </div>
                </div>
            </div>

            <!-- Visitors Metric Card with Mini Chart -->
            <div class="card bg-white dark:bg-dark-800 shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="card-body p-6 flex flex-col flex-1">
                <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-lg bg-teal-500/10 dark:bg-teal-500/20 text-teal-500 dark:text-teal-400 flex items-center justify-center">
                                <i class="fas fa-users text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Visitors</h3>
                                    <select id="visitorsRange" class="select select-bordered select-sm text-[10px] bg-white dark:bg-dark-700 border-gray-300 dark:border-dark-600 text-gray-700 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-400">
                                        <option value="7" {{ ($dateRange ?? '7') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                                        <option value="30" {{ ($dateRange ?? '7') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dropdown-end">
                            <button class="btn btn-ghost btn-sm btn-circle" tabindex="0">
                                <i class="fas fa-ellipsis-v text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100"></i>
                            </button>
                            <ul class="dropdown-content menu bg-white dark:bg-dark-700 rounded-box z-[1] w-52 p-2 shadow-lg border border-gray-200 dark:border-dark-600">
                                <li>
                                    <a href="{{ route('admin.export.daily-visitors') }}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                        <span>Export Excel</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="exportChartAsImage('dailyVisitorsChart', 'daily-visitors'); return false;" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-image text-blue-600 dark:text-blue-400"></i>
                                        <span>Export Image</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mb-4 flex-1 flex items-center">
                        <p id="visitorsTotal" class="text-4xl font-bold text-gray-900 dark:text-white">{{ number_format($metrics['unique_visitors']['value']) }}</p>
                    </div>
                    
                    <div class="mt-auto">
                        <div class="chart-container" style="height: 90px;">
                            <canvas id="dailyVisitorsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Device Types List -->
            <div class="card bg-white dark:bg-dark-800 shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="card-body p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Device Types</h3>
                            </div>
                            <select id="deviceTypesRange" class="select select-bordered select-sm text-xs bg-white dark:bg-dark-700 border-gray-300 dark:border-dark-600 text-gray-700 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-400">
                                <option value="7" {{ ($dateRange ?? '7') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                                <option value="30" {{ ($dateRange ?? '7') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                            </select>
                        </div>
                        <div class="dropdown dropdown-end">
                            <button class="btn btn-ghost btn-sm btn-circle" tabindex="0">
                                <i class="fas fa-ellipsis-v text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100"></i>
                            </button>
                            <ul class="dropdown-content menu bg-white dark:bg-dark-700 rounded-box z-[1] w-52 p-2 shadow-lg border border-gray-200 dark:border-dark-600">
                                <li>
                                    <a href="{{ route('admin.export.device-types') }}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-600">
                                        <i class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                        <span>Export Excel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="deviceTypesList" class="space-y-3">
                        @foreach($deviceTypes as $device)
                            <div class="flex items-center gap-4 py-2">
                                <!-- Icon -->
                                <div class="w-12 h-12 rounded-lg {{ $device['color'] }} flex items-center justify-center flex-shrink-0">
                                    <i class="fas {{ $device['icon'] }} text-white text-lg"></i>
                                </div>
                                
                                <!-- Labels -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $device['name'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $device['description'] }}</p>
                                </div>
                                
                                <!-- Count -->
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($device['count']) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

    const currentTheme = localStorage.getItem('theme') || 'light';
    html.classList.toggle('dark', currentTheme === 'dark');
    updateThemeIcon(currentTheme);

    themeToggle.addEventListener('click', () => {
        const isDark = html.classList.toggle('dark');
        const theme = isDark ? 'dark' : 'light';
        localStorage.setItem('theme', theme);
        updateThemeIcon(theme);
        // Update charts when theme changes
        setTimeout(() => updateChartTheme(), 100);
    });

    function updateThemeIcon(theme) {
        themeIcon.className = theme === 'dark' ? 'fas fa-sun text-xl' : 'fas fa-moon text-xl';
    }

    // Store chart instances globally for export
    let chartInstances = {};

    // Chart.js Configuration - Update on theme change
    function updateChartTheme() {
        const isDark = html.classList.contains('dark');
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.15)' : 'rgba(0, 0, 0, 0.1)';
        const textColor = isDark ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.7)';
        
        // Update all chart instances
        Object.values(chartInstances).forEach(chart => {
            if (chart && chart.options) {
                if (chart.options.scales) {
                    if (chart.options.scales.y) {
                        chart.options.scales.y.grid.color = gridColor;
                        chart.options.scales.y.ticks.color = textColor;
                    }
                    if (chart.options.scales.x) {
                        chart.options.scales.x.ticks.color = textColor;
                    }
                }
                if (chart.options.plugins) {
                    if (chart.options.plugins.tooltip) {
                        chart.options.plugins.tooltip.backgroundColor = isDark ? 'rgba(30, 30, 30, 0.95)' : 'rgba(255, 255, 255, 0.95)';
                        chart.options.plugins.tooltip.titleColor = isDark ? 'rgba(255, 255, 255, 0.9)' : 'rgba(0, 0, 0, 0.9)';
                        chart.options.plugins.tooltip.bodyColor = isDark ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)';
                        chart.options.plugins.tooltip.borderColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                    }
                }
                chart.update();
            }
        });
        
        return { gridColor, textColor };
    }

    // Get initial theme colors
        const isDark = html.classList.contains('dark');
    let { gridColor, textColor } = {
        gridColor: isDark ? 'rgba(255, 255, 255, 0.15)' : 'rgba(0, 0, 0, 0.1)',
        textColor: isDark ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.7)'
    };
    
    // Listen for theme changes
    const observer = new MutationObserver(() => {
        setTimeout(() => updateChartTheme(), 100);
    });
    observer.observe(html, { attributes: true, attributeFilter: ['class'] });

    // Shares Trend Chart (Line Chart - Last 30 Days)
    const sharesTrendCtx = document.getElementById('sharesTrendChart');
    if (sharesTrendCtx) {
        chartInstances.sharesTrendChart = new Chart(sharesTrendCtx, {
            type: 'line',
            data: {
                labels: @json($sharesTrendData['labels']),
                datasets: [{
                    label: 'Shares',
                    data: @json($sharesTrendData['values']),
                    borderColor: 'rgba(20, 184, 166, 1)',
                    backgroundColor: 'rgba(20, 184, 166, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: 'rgba(20, 184, 166, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: 'rgba(20, 184, 166, 1)',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: isDark ? 'rgba(30, 30, 30, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                        titleColor: isDark ? 'rgba(255, 255, 255, 0.9)' : 'rgba(0, 0, 0, 0.9)',
                        bodyColor: isDark ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)',
                        borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toLocaleString() + ' shares';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            stepSize: 1,
                            callback: function(value) {
                                // Only show whole numbers (no decimals)
                                if (Number.isInteger(value)) {
                                    return value.toLocaleString();
                                }
                                return '';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }


    // Daily Shares Mini Chart (Donut Chart)
    const dailySharesCtx = document.getElementById('dailySharesChart');
    if (dailySharesCtx) {
        chartInstances.dailySharesChart = new Chart(dailySharesCtx, {
            type: 'doughnut',
            data: {
                labels: @json($sharesByPlatform['labels']),
                datasets: [{
                    label: 'Shares',
                    data: @json($sharesByPlatform['values']),
                    backgroundColor: @json($sharesByPlatform['colors']),
                    borderWidth: 3,
                    borderColor: isDark ? 'rgba(0, 0, 0, 0.05)' : 'rgba(255, 255, 255, 1)',
                    hoverOffset: 6,
                    hoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                animation: {
                    animateRotate: true,
                    animateScale: false,
                    duration: 1000,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: isDark ? 'rgba(30, 30, 30, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                        titleColor: isDark ? 'rgba(255, 255, 255, 0.9)' : 'rgba(0, 0, 0, 0.9)',
                        bodyColor: isDark ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)',
                        borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true,
                        usePointStyle: true,
                        boxPadding: 6,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                let label = context.label || '';
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return label + ': ' + context.parsed.toLocaleString() + ' shares (' + percentage + '%)';
                            },
                            labelPointStyle: function(context) {
                                return {
                                    pointStyle: 'circle',
                                    rotation: 0
                                };
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'point'
                }
            }
        });
    }

    // Daily Visitors Mini Chart (Bar Chart)
    const dailyVisitorsCtx = document.getElementById('dailyVisitorsChart');
    if (dailyVisitorsCtx) {
        // Different colors for each day of the week
        const dayColors = [
            'rgba(59, 130, 246, 1)',   // Blue - Sunday
            'rgba(34, 197, 94, 1)',    // Green - Monday
            'rgba(249, 115, 22, 1)',   // Orange - Tuesday
            'rgba(168, 85, 247, 1)',   // Purple - Wednesday
            'rgba(239, 68, 68, 1)',    // Red - Thursday
            'rgba(20, 184, 166, 1)',   // Teal - Friday
            'rgba(236, 72, 153, 1)'    // Pink - Saturday
        ];
        
        chartInstances.dailyVisitorsChart = new Chart(dailyVisitorsCtx, {
            type: 'bar',
            data: {
                labels: @json($dailyVisitorsData['labels']),
                datasets: [{
                    label: 'Visitors',
                    data: @json($dailyVisitorsData['values']),
                    backgroundColor: (context) => {
                        const index = context.dataIndex;
                        return dayColors[index % dayColors.length];
                    },
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: isDark ? 'rgba(30, 30, 30, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                        titleColor: isDark ? 'rgba(255, 255, 255, 0.9)' : 'rgba(0, 0, 0, 0.9)',
                        bodyColor: isDark ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)',
                        borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true,
                        usePointStyle: true,
                        boxPadding: 6,
                        callbacks: {
                            title: function(context) {
                                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                return days[context[0].dataIndex] || context[0].label;
                            },
                            label: function(context) {
                                const value = context.parsed.y;
                                return value === 1 ? value + ' visitor' : value + ' visitors';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true
                    },
                    x: {
                        display: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    }

    // Export Chart as Image Function
    function exportChartAsImage(canvasId, filename) {
        const chart = chartInstances[canvasId];
        if (!chart) {
            alert('Chart not found. Please refresh the page.');
            return;
        }

        // Get the base64 image from the chart
        const url = chart.toBase64Image('image/png', 1);
        
        // Create a download link
        const link = document.createElement('a');
        link.download = filename + '_' + new Date().toISOString().split('T')[0] + '.png';
        link.href = url;
        
        // Trigger download
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Date Range Selection Handler - Independent for each chart
    const loadingStates = {};

    // Update Shares Trend Chart
    async function updateSharesTrend(range) {
        if (loadingStates.sharesTrend) return;
        loadingStates.sharesTrend = true;

        try {
            const response = await fetch(`{{ route('admin.chart-data') }}?range=${range}`);
            const result = await response.json();

            if (result.success && result.data.sharesTrend) {
                const data = result.data.sharesTrend;
                if (chartInstances.sharesTrendChart) {
                    chartInstances.sharesTrendChart.data.labels = data.labels;
                    chartInstances.sharesTrendChart.data.datasets[0].data = data.values;
                    chartInstances.sharesTrendChart.update();
                }
                document.getElementById('sharesTrendTotal').textContent = data.total_shares.toLocaleString();
                document.getElementById('sharesTrendAvg').textContent = data.avg_daily.toLocaleString();
            }
        } catch (error) {
            console.error('Error updating shares trend:', error);
        } finally {
            loadingStates.sharesTrend = false;
        }
    }

    // Update Shares by Platform Chart
    async function updateSharesPlatform(range) {
        if (loadingStates.sharesPlatform) return;
        loadingStates.sharesPlatform = true;

        try {
            const response = await fetch(`{{ route('admin.chart-data') }}?range=${range}`);
            const result = await response.json();

            if (result.success && result.data.sharesByPlatform) {
                const data = result.data;
                if (chartInstances.dailySharesChart) {
                    chartInstances.dailySharesChart.data.labels = data.sharesByPlatform.labels;
                    chartInstances.dailySharesChart.data.datasets[0].data = data.sharesByPlatform.values;
                    chartInstances.dailySharesChart.data.datasets[0].backgroundColor = data.sharesByPlatform.colors;
                    chartInstances.dailySharesChart.update();
                }
                document.getElementById('sharesPlatformTotal').textContent = data.metrics.total_shares.toLocaleString();
                
                const legendContainer = document.getElementById('sharesPlatformLegend');
                if (legendContainer && data.sharesByPlatform.labels.length > 0) {
                    legendContainer.innerHTML = data.sharesByPlatform.labels.map((label, index) => `
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: ${data.sharesByPlatform.colors[index]}"></div>
                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400 truncate">${label}</span>
                        </div>
                    `).join('');
                }
            }
        } catch (error) {
            console.error('Error updating shares platform:', error);
        } finally {
            loadingStates.sharesPlatform = false;
        }
    }

    // Update Top Categories
    async function updateTopCategories(range) {
        if (loadingStates.topCategories) return;
        loadingStates.topCategories = true;

        try {
            const response = await fetch(`{{ route('admin.chart-data') }}?range=${range}`);
            const result = await response.json();

            if (result.success && result.data.topCategories) {
                const data = result.data.topCategories;
                const topCategoriesList = document.getElementById('topCategoriesList');
                
                if (topCategoriesList) {
                    if (data.length === 0) {
                        topCategoriesList.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No data available</p>';
                    } else {
                        const categoryColors = {
                            'tech': 'bg-blue-500',
                            'politics': 'bg-red-500',
                            'business': 'bg-green-500',
                            'sports': 'bg-orange-500',
                            'health': 'bg-purple-500',
                            'economy': 'bg-yellow-500',
                            'nation': 'bg-indigo-500',
                            'world': 'bg-cyan-500',
                        };
                        
                        topCategoriesList.innerHTML = data.map(category => `
                            <div class="flex items-center gap-4 py-2">
                                <div class="w-12 h-12 rounded-lg ${category.color} flex items-center justify-center flex-shrink-0">
                                    <i class="fas ${category.icon} text-white text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">${category.name}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">${category.description}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">${category.shares.toLocaleString()}</p>
                                </div>
                            </div>
                        `).join('');
                    }
                }
            }
        } catch (error) {
            console.error('Error updating top categories:', error);
        } finally {
            loadingStates.topCategories = false;
        }
    }

    // Update Visitors Chart
    async function updateVisitors(range) {
        if (loadingStates.visitors) return;
        loadingStates.visitors = true;

        try {
            const response = await fetch(`{{ route('admin.chart-data') }}?range=${range}`);
            const result = await response.json();

            if (result.success && result.data.dailyVisitors && result.data.metrics) {
                const data = result.data;
                if (chartInstances.dailyVisitorsChart) {
                    // Pre-calculate colors array for proper update
                    const dayColors = [
                        'rgba(59, 130, 246, 1)',   // Blue - Sunday
                        'rgba(34, 197, 94, 1)',    // Green - Monday
                        'rgba(249, 115, 22, 1)',   // Orange - Tuesday
                        'rgba(168, 85, 247, 1)',   // Purple - Wednesday
                        'rgba(239, 68, 68, 1)',    // Red - Thursday
                        'rgba(20, 184, 166, 1)',   // Teal - Friday
                        'rgba(236, 72, 153, 1)'    // Pink - Saturday
                    ];
                    
                    // Update chart data - replace entire dataset for proper refresh
                    chartInstances.dailyVisitorsChart.data.labels = data.dailyVisitors.labels;
                    chartInstances.dailyVisitorsChart.data.datasets[0].data = data.dailyVisitors.values;
                    // Update backgroundColor as array instead of function for proper refresh
                    chartInstances.dailyVisitorsChart.data.datasets[0].backgroundColor = data.dailyVisitors.values.map((_, index) => 
                        dayColors[index % dayColors.length]
                    );
                    // Force update with animation
                    chartInstances.dailyVisitorsChart.update();
                }
                // Update total visitors count
                const visitorsTotalEl = document.getElementById('visitorsTotal');
                if (visitorsTotalEl) {
                    visitorsTotalEl.textContent = data.metrics.unique_visitors.toLocaleString();
                }
            } else {
                console.error('Invalid response structure:', result);
            }
        } catch (error) {
            console.error('Error updating visitors:', error);
        } finally {
            loadingStates.visitors = false;
        }
    }

    // Update Device Types
    async function updateDeviceTypes(range) {
        if (loadingStates.deviceTypes) return;
        loadingStates.deviceTypes = true;

        try {
            const response = await fetch(`{{ route('admin.chart-data') }}?range=${range}`);
            const result = await response.json();

            if (result.success && result.data.deviceTypes) {
                const data = result.data.deviceTypes;
                const deviceTypesList = document.getElementById('deviceTypesList');
                
                if (deviceTypesList) {
                    if (data.length === 0) {
                        deviceTypesList.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No data available</p>';
                    } else {
                        deviceTypesList.innerHTML = data.map(device => `
                            <div class="flex items-center gap-4 py-2">
                                <div class="w-12 h-12 rounded-lg ${device.color} flex items-center justify-center flex-shrink-0">
                                    <i class="fas ${device.icon} text-white text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">${device.name}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">${device.description}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">${device.count.toLocaleString()}</p>
                                </div>
                            </div>
                        `).join('');
                    }
                } else {
                    console.error('Device types list element not found');
                }
            } else {
                console.error('Invalid response structure:', result);
            }
        } catch (error) {
            console.error('Error updating device types:', error);
        } finally {
            loadingStates.deviceTypes = false;
        }
    }

    // Add event listeners to date range selectors - each independent
    function attachEventListeners() {
        // Shares Trend
        const sharesTrendRange = document.getElementById('sharesTrendRange');
        if (sharesTrendRange) {
            sharesTrendRange.addEventListener('change', function() {
                updateSharesTrend(this.value);
            });
        }

        // Shares Platform
        const sharesPlatformRange = document.getElementById('sharesPlatformRange');
        if (sharesPlatformRange) {
            sharesPlatformRange.addEventListener('change', function() {
                updateSharesPlatform(this.value);
            });
        }

        // Top Categories
        const topCategoriesRange = document.getElementById('topCategoriesRange');
        if (topCategoriesRange) {
            topCategoriesRange.addEventListener('change', function() {
                updateTopCategories(this.value);
            });
        }

        // Visitors
        const visitorsRange = document.getElementById('visitorsRange');
        if (visitorsRange) {
            visitorsRange.addEventListener('change', function(e) {
                const range = e.target.value;
                updateVisitors(range);
            });
        }

        // Device Types
        const deviceTypesRange = document.getElementById('deviceTypesRange');
        if (deviceTypesRange) {
            deviceTypesRange.addEventListener('change', function(e) {
                const range = e.target.value;
                updateDeviceTypes(range);
            });
        }
    }

    // Attach listeners when DOM is ready or immediately if already loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', attachEventListeners);
    } else {
        // DOM is already loaded
        attachEventListeners();
    }

</script>
@endpush
