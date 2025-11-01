@extends('layouts.app')

@section('title', 'Berita Malaysia - Portal Berita Terkini')

@section('content')
<!-- Hero Section -->
<section class="bg-secondary text-light py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Berita Malaysia
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-accent max-w-3xl mx-auto">
                Portal berita terkini dan terpercaya untuk rakyat Malaysia
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/berita" class="bg-accent text-primary px-8 py-4 rounded-lg font-bold text-lg hover:bg-light hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-newspaper mr-2"></i>Baca Berita Terkini
                </a>
                <a href="#news" class="border-2 border-accent text-accent px-8 py-4 rounded-lg font-bold text-lg hover:bg-accent hover:text-primary transition-all duration-300">
                    <i class="fas fa-arrow-down mr-2"></i>Lihat Cerita
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" id="news">
    <!-- Featured News Section -->
    <div class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-primary mb-4">
                <i class="fas fa-star text-accent mr-3"></i>Cerita Utama
            </h2>
            <p class="text-secondary text-lg">Berita terhangat dan paling penting untuk anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- News Card 1 -->
            <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1586339949916-3e9457bef6d3?w=500&h=300&fit=crop" 
                         alt="Berita Utama" 
                         class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-primary px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-fire mr-1"></i>HOT
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                        PM Anwar Ibrahim Umumkan Rancangan Ekonomi Baru
                    </h3>
                    <p class="text-secondary mb-4 line-clamp-3">
                        Perdana Menteri Malaysia mengumumkan pelan ekonomi komprehensif untuk meningkatkan pertumbuhan negara dan mengurangkan kos sara hidup rakyat.
                    </p>
                    <div class="flex items-center text-sm text-secondary mb-4">
                        <i class="fas fa-clock mr-2 text-accent"></i>
                        <span>2 jam yang lalu</span>
                        <span class="mx-2">•</span>
                        <span class="bg-primary text-light px-2 py-1 rounded text-xs">Berita</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/berita" class="text-accent hover:text-primary font-semibold transition-colors">
                            Baca Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- News Card 2 -->
            <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                         alt="Sukan" 
                         class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-trophy mr-1"></i>SPORT
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                        Harimau Malaya Menang 3-1 Lawan Singapura
                    </h3>
                    <p class="text-secondary mb-4 line-clamp-3">
                        Pasukan bola sepak kebangsaan Malaysia mencatat kemenangan gemilang dalam perlawanan persahabatan menentang Singapura di Stadium Nasional Bukit Jalil.
                    </p>
                    <div class="flex items-center text-sm text-secondary mb-4">
                        <i class="fas fa-clock mr-2 text-accent"></i>
                        <span>4 jam yang lalu</span>
                        <span class="mx-2">•</span>
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/sukan" class="text-accent hover:text-primary font-semibold transition-colors">
                            Baca Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- News Card 3 -->
            <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                         alt="Hiburan" 
                         class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-music mr-1"></i>ENTERTAINMENT
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                        Konsert Dato' Siti Nurhaliza Dijual Habis
                    </h3>
                    <p class="text-secondary mb-4 line-clamp-3">
                        Konsert solo terbaru Dato' Siti Nurhaliza di Stadium Merdeka berjaya dijual habis dalam masa 2 jam sahaja, membuktikan populariti penyanyi terkenal itu.
                    </p>
                    <div class="flex items-center text-sm text-secondary mb-4">
                        <i class="fas fa-clock mr-2 text-accent"></i>
                        <span>6 jam yang lalu</span>
                        <span class="mx-2">•</span>
                        <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/hiburan" class="text-accent hover:text-primary font-semibold transition-colors">
                            Baca Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- News Card 4 -->
            <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                         alt="Dunia" 
                         class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-globe mr-1"></i>WORLD
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                        Malaysia Tegaskan Komitmen Terhadap ASEAN
                    </h3>
                    <p class="text-secondary mb-4 line-clamp-3">
                        Menteri Luar Negeri Malaysia menegaskan komitmen negara terhadap kerjasama ASEAN dalam menangani cabaran serantau dan global.
                    </p>
                    <div class="flex items-center text-sm text-secondary mb-4">
                        <i class="fas fa-clock mr-2 text-accent"></i>
                        <span>8 jam yang lalu</span>
                        <span class="mx-2">•</span>
                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/dunia" class="text-accent hover:text-primary font-semibold transition-colors">
                            Baca Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- News Card 5 -->
            <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=500&h=300&fit=crop" 
                         alt="Teknologi" 
                         class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-microchip mr-1"></i>TECH
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                        Malaysia Akan Jadi Hub Teknologi Digital ASEAN
                    </h3>
                    <p class="text-secondary mb-4 line-clamp-3">
                        Kerajaan Malaysia mengumumkan pelan untuk menjadikan negara sebagai pusat teknologi digital terkemuka di rantau ASEAN menjelang 2030.
                    </p>
                    <div class="flex items-center text-sm text-secondary mb-4">
                        <i class="fas fa-clock mr-2 text-accent"></i>
                        <span>10 jam yang lalu</span>
                        <span class="mx-2">•</span>
                        <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs">Teknologi</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/berita" class="text-accent hover:text-primary font-semibold transition-colors">
                            Baca Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- News Card 6 -->
            <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                         alt="Sukan" 
                         class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-trophy mr-1"></i>CHAMPION
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                        Pemain Badminton Malaysia Juara Kejohanan Dunia
                    </h3>
                    <p class="text-secondary mb-4 line-clamp-3">
                        Pemain badminton kebangsaan Malaysia berjaya meraih gelaran juara dunia dalam kategori perseorangan lelaki di Kejohanan Badminton Dunia 2024.
                    </p>
                    <div class="flex items-center text-sm text-secondary mb-4">
                        <i class="fas fa-clock mr-2 text-accent"></i>
                        <span>12 jam yang lalu</span>
                        <span class="mx-2">•</span>
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/sukan" class="text-accent hover:text-primary font-semibold transition-colors">
                            Baca Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="#" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- Category Quick Access -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h3 class="text-2xl font-bold text-primary mb-6 text-center">
            <i class="fas fa-th-large text-accent mr-2"></i>Kategori Berita
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="/berita" class="bg-primary text-light p-6 rounded-lg text-center hover:bg-secondary transform hover:-translate-y-1 transition-all duration-300 group">
                <i class="fas fa-newspaper text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h4 class="font-bold text-lg">Berita</h4>
                <p class="text-sm opacity-90">Berita terkini</p>
            </a>
            <a href="/sukan" class="bg-green-500 text-white p-6 rounded-lg text-center hover:bg-green-600 transform hover:-translate-y-1 transition-all duration-300 group">
                <i class="fas fa-futbol text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h4 class="font-bold text-lg">Sukan</h4>
                <p class="text-sm opacity-90">Sukan & Olahraga</p>
            </a>
            <a href="/hiburan" class="bg-purple-500 text-white p-6 rounded-lg text-center hover:bg-purple-600 transform hover:-translate-y-1 transition-all duration-300 group">
                <i class="fas fa-music text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h4 class="font-bold text-lg">Hiburan</h4>
                <p class="text-sm opacity-90">Hiburan & Artis</p>
            </a>
            <a href="/dunia" class="bg-blue-500 text-white p-6 rounded-lg text-center hover:bg-blue-600 transform hover:-translate-y-1 transition-all duration-300 group">
                <i class="fas fa-globe text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h4 class="font-bold text-lg">Dunia</h4>
                <p class="text-sm opacity-90">Berita Dunia</p>
            </a>
        </div>
    </div>
</main>
@endsection