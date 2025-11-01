@extends('layouts.app')

@section('title', 'Berita - Berita Malaysia')

@section('content')
<!-- Page Title -->
<section class="bg-secondary text-light py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <i class="fas fa-newspaper text-accent mr-3"></i>Berita Terkini
        </h1>
        <p class="text-xl text-accent">Berita terkini dan terpercaya dari Malaysia</p>
    </div>
</section>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
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
                    <a href="#" class="text-accent hover:text-primary font-semibold transition-colors">
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
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                     alt="Berita Politik" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-landmark mr-1"></i>POLITIK
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Kerajaan Perkenalkan Dasar Baru untuk Pendidikan
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Kementerian Pendidikan Malaysia mengumumkan dasar baru untuk meningkatkan kualiti pendidikan di seluruh negara.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>4 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-primary text-light px-2 py-1 rounded text-xs">Berita</span>
                </div>
                <div class="flex justify-between items-center">
                    <a href="#" class="text-accent hover:text-primary font-semibold transition-colors">
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
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=500&h=300&fit=crop" 
                     alt="Berita Ekonomi" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-chart-line mr-1"></i>EKONOMI
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Ringgit Malaysia Mengukuh Berbanding Dolar AS
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Nilai ringgit Malaysia menunjukkan peningkatan yang positif berbanding dolar Amerika Syarikat dalam pasaran pertukaran asing.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>6 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-primary text-light px-2 py-1 rounded text-xs">Berita</span>
                </div>
                <div class="flex justify-between items-center">
                    <a href="#" class="text-accent hover:text-primary font-semibold transition-colors">
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
                <img src="https://images.unsplash.com/photo-1586339949916-3e9457bef6d3?w=500&h=300&fit=crop" 
                     alt="Berita Sosial" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-users mr-1"></i>SOSIAL
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Program Bantuan Rakyat 2024 Dilancarkan
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Kerajaan melancarkan program bantuan rakyat terbaru untuk membantu keluarga yang memerlukan di seluruh Malaysia.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>8 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-primary text-light px-2 py-1 rounded text-xs">Berita</span>
                </div>
                <div class="flex justify-between items-center">
                    <a href="#" class="text-accent hover:text-primary font-semibold transition-colors">
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
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                     alt="Berita Kesihatan" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-heartbeat mr-1"></i>KESIHATAN
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Kempen Vaksinasi Terkini untuk Warga Emas
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Kementerian Kesihatan melancarkan kempen vaksinasi terkini khusus untuk warga emas di seluruh negara.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>10 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-primary text-light px-2 py-1 rounded text-xs">Berita</span>
                </div>
                <div class="flex justify-between items-center">
                    <a href="#" class="text-accent hover:text-primary font-semibold transition-colors">
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
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=500&h=300&fit=crop" 
                     alt="Berita Teknologi" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-microchip mr-1"></i>TEKNOLOGI
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
                    <span>12 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-primary text-light px-2 py-1 rounded text-xs">Berita</span>
                </div>
                <div class="flex justify-between items-center">
                    <a href="#" class="text-accent hover:text-primary font-semibold transition-colors">
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
</main>
@endsection