@extends('layouts.app')

@section('title', 'Sukan - Berita Malaysia')

@section('content')
<!-- Page Title -->
<section class="bg-secondary text-light py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <i class="fas fa-futbol text-accent mr-3"></i>Berita Sukan
        </h1>
        <p class="text-xl text-accent">Berita sukan terkini dari Malaysia dan dunia</p>
    </div>
</section>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- News Card 1 -->
        <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                     alt="Bola Sepak" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-futbol mr-1"></i>BOLA SEPAK
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
                    <span>2 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
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
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                     alt="Badminton" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-trophy mr-1"></i>BADMINTON
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
                    <span>4 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
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
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                     alt="Olimpik" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-medal mr-1"></i>OLIMPIK
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Atlet Malaysia Siap untuk Sukan Olimpik Paris 2024
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Pasukan kontinjen Malaysia telah bersiap sedia untuk menyertai Sukan Olimpik Paris 2024 dengan harapan meraih pingat emas.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>6 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
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
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                     alt="Formula 1" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-car mr-1"></i>FORMULA 1
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Grand Prix Malaysia 2024 Kembali ke Sepang
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Litar Sepang akan menjadi tuan rumah Grand Prix Malaysia 2024 dengan jangkaan menarik ribuan peminat Formula 1.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>8 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
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
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                     alt="Tenis" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-table-tennis mr-1"></i>TENIS
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Pemain Tenis Malaysia Raih Kemenangan di Kejohanan Asia
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Pemain tenis kebangsaan Malaysia berjaya meraih kemenangan dalam kejohanan tenis Asia di Kuala Lumpur.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>10 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
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
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" 
                     alt="Renang" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-swimmer mr-1"></i>RENANG
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Perenang Malaysia Pecah Rekod Kebangsaan
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Perenang kebangsaan Malaysia berjaya memecahkan rekod kebangsaan dalam acara renang gaya bebas 100 meter.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>12 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Sukan</span>
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