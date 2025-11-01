@extends('layouts.app')

@section('title', 'Hiburan - Berita Malaysia')

@section('content')
<!-- Page Title -->
<section class="bg-secondary text-light py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <i class="fas fa-music text-accent mr-3"></i>Hiburan
        </h1>
        <p class="text-xl text-accent">Berita hiburan terkini dari Malaysia dan dunia</p>
    </div>
</section>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- News Card 1 -->
        <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                     alt="Konsert" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-music mr-1"></i>KONSERT
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
                    <span>2 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
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
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                     alt="Filem" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-film mr-1"></i>FILEM
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Filem Malaysia 'Pendekar Awang' Raih Anugerah Antarabangsa
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Filem tempatan 'Pendekar Awang' berjaya meraih anugerah filem terbaik di Festival Filem Antarabangsa.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>4 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
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
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                     alt="Drama" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-tv mr-1"></i>DRAMA
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Drama 'Cinta Di Kampung' Raih Rating Tertinggi
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Drama tempatan 'Cinta Di Kampung' berjaya meraih rating tertinggi dalam sejarah drama Malaysia.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>6 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
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
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                     alt="Artis" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-star mr-1"></i>ARTIS
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Artis Malaysia Terpilih Sebagai Duta Merek Global
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Artis terkenal Malaysia telah dipilih sebagai duta merek global untuk produk kecantikan antarabangsa.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>8 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
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
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                     alt="Komedi" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-laugh mr-1"></i>KOMEDI
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Komedian Malaysia Raih Anugerah Komedi Terbaik
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Komedian tempatan berjaya meraih anugerah komedi terbaik di Anugerah Komedi Malaysia 2024.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>10 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
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
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=300&fit=crop" 
                     alt="Muzik" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-music mr-1"></i>MUZIK
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Lagu Malaysia Masuk Carta Muzik Antarabangsa
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Lagu tempatan berjaya masuk carta muzik antarabangsa dan mendapat sambutan hangat dari peminat global.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>12 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs">Hiburan</span>
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