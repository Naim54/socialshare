<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SocialShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
                        'space': ['Space Grotesk', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '100%': { boxShadow: '0 0 30px rgba(59, 130, 246, 0.8)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            animation: float 8s ease-in-out infinite;
        }
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }
    </style>
</head>
<body class="font-inter min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50 relative overflow-hidden">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center bg-no-repeat" 
             style="background-image: url('{{ asset("images/bg.jpg") }}');">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/20 via-transparent to-cyan-900/20"></div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-6xl">
            <!-- Main Card Container -->
            <div class="flex flex-col lg:flex-row bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20">
                
                <!-- Left Side - Login Form -->
                <div class="flex-1 p-8 lg:p-12 flex flex-col justify-center">
                    <!-- Header -->
                    <div class="text-center mb-8 animate-fade-in">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl mb-4 animate-glow">
                            <i class="fas fa-share-alt text-white text-2xl"></i>
                        </div>
                        <p class="text-gray-600 text-lg">Sign in to your SocialShare admin account</p>
                    </div>

                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="alert alert-error mb-6 animate-slide-up">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6 animate-slide-up">
        @csrf
                        
                        <!-- Email Field -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-gray-700 font-medium">Email Address</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="email" 
                                    name="email" 
                                    placeholder="admin@example.com"
                                    value="{{ old('email') }}"
                                    class="input input-bordered w-full pl-12 pr-4 py-4 text-lg focus:input-primary transition-all duration-300"
                                    required
                                />
                                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-gray-700 font-medium">Password</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    name="password" 
                                    placeholder="Enter your password"
                                    class="input input-bordered w-full pl-12 pr-20 py-4 text-lg focus:input-primary transition-all duration-300"
                                    required
                                />
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <a href="#" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-sm text-primary hover:text-primary-focus transition-colors">
                                    Forgot?
                                </a>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-3">
                                <input type="checkbox" class="checkbox checkbox-primary" />
                                <span class="label-text text-gray-600">Remember me for 30 days</span>
                            </label>
                        </div>

                        <!-- Login Button -->
<!-- Include lucide-react icons or use SVG directly -->
                        <button type="submit" class="flex items-center justify-center gap-2 w-full py-4 text-lg font-semibold text-white bg-[#027cb3] rounded-xl shadow-md hover:bg-[#026a99] transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Submit
                        </button>

    </form>

                </div>

                <!-- Right Side - Modern Geometric Design -->
                <div class="flex-1 relative overflow-hidden bg-gradient-to-br from-slate-900/90 via-blue-900/80 to-purple-900/90 backdrop-blur-sm">
                    <!-- Geometric Background -->
                    <div class="absolute inset-0">
                        <!-- Large geometric shapes -->
                        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan-500/20 to-transparent rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-purple-500/20 to-transparent rounded-full blur-3xl"></div>
                        
                        <!-- Geometric lines -->
                        <div class="absolute top-1/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        <div class="absolute top-3/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        
                        <!-- Floating geometric shapes -->
                        <div class="absolute top-20 left-20 w-4 h-4 bg-white/30 rotate-45 animate-pulse"></div>
                        <div class="absolute top-40 right-32 w-6 h-6 bg-cyan-400/40 rounded-full animate-bounce"></div>
                        <div class="absolute bottom-32 left-32 w-3 h-3 bg-purple-400/50 rotate-45 animate-ping"></div>
                        <div class="absolute bottom-20 right-20 w-5 h-5 bg-pink-400/40 rounded-full animate-pulse"></div>
                    </div>
                    
                    <!-- Main Content -->
                    <div class="relative z-10 h-full flex flex-col justify-center items-center text-center text-white p-12">
                        <!-- Modern Logo -->
                        <div class="mb-16">
                            <div class="relative group">
                                <div class="w-24 h-24 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/20 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-share-alt text-3xl text-white"></i>
                                </div>
                                <div class="absolute -inset-2 bg-gradient-to-r from-cyan-400 to-purple-500 rounded-2xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <!-- Modern Typography -->
                        <div class="mb-16 space-y-6">
                            <h2 class="font-space text-5xl lg:text-6xl font-bold tracking-tight">
                                <span class="bg-gradient-to-r from-white via-cyan-100 to-blue-200 bg-clip-text text-transparent">
                                    SocialShare
                                </span>
                            </h2>
                            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-500 mx-auto rounded-full"></div>
                            <p class="font-poppins text-lg text-white/80 max-w-sm leading-relaxed font-light">
                                Transform your social media presence with intelligent automation and powerful analytics.
                            </p>
                        </div>

                        <!-- Modern Feature Grid -->
                        <div class="grid grid-cols-1 gap-4 w-full max-w-xs">
                            <div class="group p-4 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-chart-line text-white text-sm"></i>
                                    </div>
                                    <span class="font-poppins text-sm font-medium text-white">Smart Analytics</span>
                                </div>
                            </div>
                            
                            <div class="group p-4 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-users text-white text-sm"></i>
                                    </div>
                                    <span class="font-poppins text-sm font-medium text-white">Community Growth</span>
                                </div>
                            </div>
                            
                            <div class="group p-4 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-red-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-rocket text-white text-sm"></i>
                                    </div>
                                    <span class="font-poppins text-sm font-medium text-white">Analytic Dashboard</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom accent -->
                        <div class="mt-16 flex items-center space-x-2 text-white/60">
                            <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                            <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add CSS for ripple effect
            const style = document.createElement('style');
            style.textContent = `
                .ripple {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.6);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    pointer-events: none;
                }
                
                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
