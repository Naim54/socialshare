@extends('layouts.app')

@section('title', 'Dunia - Berita Malaysia')

@section('content')
<!-- Page Title -->
<section class="bg-secondary text-light py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <i class="fas fa-globe text-accent mr-3"></i>Berita Dunia
        </h1>
        <p class="text-xl text-accent">Berita terkini dari seluruh dunia</p>
    </div>
</section>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- News Card 1 -->
        <article class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-accent/20">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                     alt="Berita Dunia" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-globe mr-1"></i>DUNIA
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
                    <span>2 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
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
                     alt="Ekonomi Global" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-chart-line mr-1"></i>EKONOMI
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Pertumbuhan Ekonomi Global Meningkat pada 2024
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Pertumbuhan ekonomi global menunjukkan peningkatan yang positif pada tahun 2024 dengan ramalan yang menggalakkan.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>4 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
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
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                     alt="Teknologi" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-microchip mr-1"></i>TEKNOLOGI
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Revolusi AI Mengubah Cara Kerja di Seluruh Dunia
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Teknologi kecerdasan buatan (AI) terus mengubah cara kerja di pelbagai industri di seluruh dunia.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>6 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
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
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                     alt="Kesihatan" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-heartbeat mr-1"></i>KESIHATAN
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    WHO Umumkan Kemajuan dalam Penanganan Pandemi Global
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Pertubuhan Kesihatan Sedunia (WHO) mengumumkan kemajuan yang signifikan dalam penanganan pandemi global.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>8 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
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
                     alt="Alam Sekitar" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-leaf mr-1"></i>ALAM SEKITAR
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Pertubuhan Bangsa-Bangsa Bersatu Lancar Inisiatif Hijau Global
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    PBB melancarkan inisiatif hijau global untuk menangani perubahan iklim dan mempromosikan pembangunan mampan.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>10 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
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
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=300&fit=crop" 
                     alt="Politik" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 left-4">
                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-landmark mr-1"></i>POLITIK
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                    Sidang Kemuncak G20 Bahas Isu Global Penting
                </h3>
                <p class="text-secondary mb-4 line-clamp-3">
                    Sidang Kemuncak G20 membincangkan isu-isu global penting termasuk ekonomi, kesihatan, dan perubahan iklim.
                </p>
                <div class="flex items-center text-sm text-secondary mb-4">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    <span>12 jam yang lalu</span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Dunia</span>
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