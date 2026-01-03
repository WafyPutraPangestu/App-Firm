<x-layout>
    <div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Toast Notification -->
        <div x-data="{ show: false, message: '', type: 'success' }" 
             @toast.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
             x-show="show"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-5 right-5 z-50 max-w-sm w-full"
             style="display: none;">
            <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
                <div class="p-4 flex items-center gap-3">
                    <div :class="type === 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'" 
                         class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center">
                        <svg x-show="type === 'success'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <svg x-show="type === 'error'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <p class="text-gray-800 font-medium" x-text="message"></p>
                </div>
                <div :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'" 
                     class="h-1 animate-progress"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
            <div x-data="{ 
                mouseX: 0, 
                mouseY: 0,
                emailFocused: false,
                passwordFocused: false,
                handleMouseMove(e) {
                    this.mouseX = e.clientX / window.innerWidth;
                    this.mouseY = e.clientY / window.innerHeight;
                },
                handleSubmit(e) {
                    const email = this.$refs.email.value;
                    const password = this.$refs.password.value;
                    
                    if (!email || !password) {
                        e.preventDefault();
                        this.$dispatch('toast', { message: 'Please fill in all fields', type: 'error' });
                        return false;
                    }
                    
                    // Form akan submit secara normal ke Laravel
                    return true;
                }
            }" 
            @mousemove="handleMouseMove"
            class="w-full max-w-6xl">
                
                <!-- Login Card -->
                <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20"
                     :style="`transform: perspective(1000px) rotateY(${mouseX * 5 - 2.5}deg) rotateX(${-mouseY * 5 + 2.5}deg)`">
                    
                    <form action="{{ route('login') }}" method="POST" @submit="handleSubmit">
                        @csrf
                        
                        <!-- Header -->
                        <div class="text-center py-8 px-6 bg-gradient-to-r from-purple-600/30 to-pink-600/30">
                            <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 tracking-tight">
                                Halama Login
                            </h1>
                            <p class="text-purple-200 text-sm">Welcome back! Please login to your account</p>
                        </div>

                        <!-- Form Content -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                            
                            <!-- Left Side - Image -->
                            <div class="hidden md:block relative overflow-hidden bg-gradient-to-br from-purple-600 to-pink-600 p-12">
                                <div class="absolute inset-0 opacity-10">
                                    <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNnoiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLXdpZHRoPSIyIi8+PC9nPjwvc3ZnPg==')]"></div>
                                </div>
                                <div class="relative z-10 h-full flex items-center justify-center"
                                     :style="`transform: translateY(${mouseY * 20}px)`">
                                    <img src="{{ Vite::asset('resources/asset/home/bg1.png') }}" 
                                         alt="Login Illustration" 
                                         class="w-full h-auto max-w-md rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                                </div>
                            </div>

                            <!-- Right Side - Form -->
                            <div class="p-8 md:p-12 flex flex-col justify-center bg-white/5"
                                 :style="`transform: translateX(${-mouseX * 10}px)`">
                                
                                <!-- Email Input -->
                                <div class="mb-6 transform transition-all duration-300"
                                     :class="emailFocused ? 'scale-105' : 'scale-100'">
                                    <label for="email" 
                                           class="block text-sm font-semibold text-purple-200 mb-2 uppercase tracking-wide">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                            </svg>
                                        </div>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               x-ref="email"
                                               @focus="emailFocused = true" 
                                               @blur="emailFocused = false"
                                               placeholder="Enter your email"
                                               class="w-full pl-12 pr-4 py-3.5 bg-white/10 border-2 border-purple-300/30 rounded-xl text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                                               >
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="mb-8 transform transition-all duration-300"
                                     :class="passwordFocused ? 'scale-105' : 'scale-100'">
                                    <label for="password" 
                                           class="block text-sm font-semibold text-purple-200 mb-2 uppercase tracking-wide">
                                        Password
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <input type="password" 
                                               id="password" 
                                               name="password" 
                                               x-ref="password"
                                               @focus="passwordFocused = true" 
                                               @blur="passwordFocused = false"
                                               placeholder="Enter your password"
                                               class="w-full pl-12 pr-4 py-3.5 bg-white/10 border-2 border-purple-300/30 rounded-xl text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                                               >
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
                                        class="group relative w-full py-4 px-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-purple-400/50">
                                    <span class="relative z-10 flex items-center justify-center gap-2">
                                        Login
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                                </button>

                                <!-- Additional Links -->
                                <div class="mt-6 text-center">
                                    <a href="#" class="text-sm text-purple-200 hover:text-white transition-colors duration-300">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Bottom Text -->
                <p class="text-center text-purple-200 mt-8 text-sm">
                    Don't have an account? 
                    <a href="#" class="text-white font-semibold hover:underline transition-all duration-300">
                        Sign up now
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes progress {
            from { width: 100%; }
            to { width: 0%; }
        }

        .animate-progress {
            animation: progress 3s linear;
        }
    </style>
</x-layout>