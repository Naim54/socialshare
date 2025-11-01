<!-- Header -->
<header class="bg-primary shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-light hover:text-accent transition-colors">
                    <i class="fas fa-newspaper mr-2"></i>
                    Berita Malaysia
                </a>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-light px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->is('/') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-home mr-1"></i>Utama
                </a>
                <a href="/berita" class="text-light px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->is('berita') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-newspaper mr-1"></i>Berita
                </a>
                <a href="/sukan" class="text-light px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->is('sukan') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-futbol mr-1"></i>Sukan
                </a>
                <a href="/hiburan" class="text-light px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->is('hiburan') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-music mr-1"></i>Hiburan
                </a>
                <a href="/dunia" class="text-light px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->is('dunia') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-globe mr-1"></i>Dunia
                </a>
            </nav>
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-light hover:text-accent focus:outline-none focus:text-accent" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-primary">
                <a href="/" class="text-light block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-home mr-2"></i>Utama
                </a>
                <a href="/berita" class="text-light block px-3 py-2 rounded-md text-base font-medium {{ request()->is('berita') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-newspaper mr-2"></i>Berita
                </a>
                <a href="/sukan" class="text-light block px-3 py-2 rounded-md text-base font-medium {{ request()->is('sukan') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-futbol mr-2"></i>Sukan
                </a>
                <a href="/hiburan" class="text-light block px-3 py-2 rounded-md text-base font-medium {{ request()->is('hiburan') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-music mr-2"></i>Hiburan
                </a>
                <a href="/dunia" class="text-light block px-3 py-2 rounded-md text-base font-medium {{ request()->is('dunia') ? 'bg-secondary text-accent' : 'hover:text-accent hover:bg-secondary' }}">
                    <i class="fas fa-globe mr-2"></i>Dunia
                </a>
            </div>
        </div>
    </div>
</header>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
}
</script>

