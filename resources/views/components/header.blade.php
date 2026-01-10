<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">
    <nav class="relative text-white backdrop-blur-sm transition-all duration-500" 
         :class="scrolled ? 
            'bg-gradient-to-r from-red-950 via-red-900 to-red-950 bg-opacity-95 shadow-2xl' : 
            'bg-gradient-to-r from-red-950 via-red-900 to-red-950 bg-opacity-100 shadow-none'">
        <div class="absolute inset-0 overflow-hidden opacity-10">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.1),transparent)]" style="transform: translateY(var(--scroll-y, 0))"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between relative z-10 transition-all duration-500" :class="scrolled ? 'h-16' : 'h-20'">
                <!-- Logo -->
                <div class="transform transition-all duration-500 hover:scale-105 flex-shrink-0">
                    <a href="/" class="block relative group">
                        <img src="{{ Vite::asset('resources/asset/home/logo-ats.png') }}" 
                             alt="Logo" 
                             class="transition-all duration-500 filter drop-shadow-2xl object-contain" 
                             :class="scrolled ? 'h-10' : 'h-14'">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-orange-500 opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-300 rounded-full"></div>
                    </a>
                </div>

                {{-- GUEST MENU --}}
                @if(!Auth::check() && !session('client_id'))
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/home#home" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->is('home') || request()->is('/')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->is('home') || request()->is('/')) text-orange-400 @endif">Home</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/home#about" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">About</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/home#profile" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">Profile</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->is('/')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->is('/')) text-orange-400 @endif">Data Client</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                </div>
                @endif

                {{-- ADMIN MENU --}}
                @can('admin')
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/home#home" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->is('home')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->is('home')) text-orange-400 @endif">Home</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/home#about" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">About</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/home#profile" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">Profile</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->routeIs('admin.dashboard')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->routeIs('admin.dashboard')) text-orange-400 @endif">Dashboard</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="{{ route('admin.clients.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->routeIs('admin.clients.*')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->routeIs('admin.clients.*')) text-orange-400 @endif">Manajemen Clients</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="{{ route('admin.chat.index') }}" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->routeIs('admin.chat.*')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->routeIs('admin.chat.*')) text-orange-400 @endif">Manajemen Chat</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                </div>
                @endcan

                {{-- CLIENT MENU --}}
                @if(session('client_id'))
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/home#home" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->is('home')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->is('home')) text-orange-400 @endif">Home</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/home#about" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">About</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="/home#profile" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">Profile</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="{{ route('user.clients.dashboard', session('client_id')) }}" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->routeIs('user.clients.dashboard')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->routeIs('user.clients.dashboard')) text-orange-400 @endif">Dashboard</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                    <a href="{{ route('user.clients.show', session('client_id')) }}" 
                       class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group overflow-hidden rounded-lg @if(request()->routeIs('user.clients.show')) border-b-2 border-orange-400 @endif">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300 @if(request()->routeIs('user.clients.show')) text-orange-400 @endif">Manajemen Progres</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                    </a>
                </div>
                @endif

                {{-- LOGIN BUTTON (GUEST) --}}
                @if(!Auth::check() && !session('client_id'))
                <div class="hidden md:flex items-center gap-3 flex-shrink-0">
                    <a href="{{ route('login') }}" 
                       class="relative px-5 py-2 text-sm font-semibold overflow-hidden rounded-lg border-2 border-white group transition-all duration-300 hover:shadow-xl hover:shadow-red-500/50">
                        <span class="relative z-10 group-hover:text-red-900 transition-colors duration-300">Login</span>
                        <span class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                </div>
                @endif

                {{-- AUTH BUTTON (ADMIN) --}}
                @auth
                <div class="hidden md:flex items-center gap-3 flex-shrink-0">
                    <div class="flex items-center gap-2 px-3 py-1.5 bg-red-800/50 rounded-lg">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium whitespace-nowrap">{{ auth()->user()->name }}</span>
                    </div>
                    <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="relative px-5 py-2 text-sm font-semibold overflow-hidden rounded-lg border-2 border-white group transition-all duration-300 hover:shadow-xl hover:shadow-red-500/50">
                            <span class="relative z-10 group-hover:text-red-900 transition-colors duration-300">Logout</span>
                            <span class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        </button>
                    </form>
                </div>
                @endauth

                {{-- CLIENT BUTTON (USER) --}}
                @if(session('client_id'))
                <div class="hidden md:flex items-center gap-3 flex-shrink-0">
                    <div class="flex items-center gap-2 px-3 py-1.5 bg-blue-800/50 rounded-lg">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">{{ substr(session('client_name'), 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium whitespace-nowrap">{{ session('client_name') }}</span>
                    </div>
                    <form action="{{ route('user.clients.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="relative px-5 py-2 text-sm font-semibold overflow-hidden rounded-lg border-2 border-white group transition-all duration-300 hover:shadow-xl hover:shadow-red-500/50">
                            <span class="relative z-10 group-hover:text-red-900 transition-colors duration-300">Logout</span>
                            <span class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        </button>
                    </form>
                </div>
                @endif

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden relative w-10 h-10 text-white focus:outline-none group flex-shrink-0">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="sr-only">Open menu</span>
                        <div class="space-y-1.5">
                            <span class="block w-6 h-0.5 bg-white transform transition-all duration-300" :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''"></span>
                            <span class="block w-6 h-0.5 bg-white transition-all duration-300" :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
                            <span class="block w-6 h-0.5 bg-white transform transition-all duration-300" :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''"></span>
                        </div>
                    </div>
                </button>
            </div>
        </div>

        {{-- MOBILE MENU - GUEST --}}
        @if(!Auth::check() && !session('client_id'))
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="md:hidden bg-gradient-to-b from-red-950 to-red-900 shadow-2xl border-t border-red-800"
             @click.away="mobileMenuOpen = false"
             style="display: none;">
            <div class="px-4 py-6 space-y-3">
                <a href="/home#home" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->is('home') || request()->is('/')) bg-red-800 text-orange-400 @endif">
                    Home
                </a>
                <a href="/home#about" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2">
                    About
                </a>
                <a href="/home#profile" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2">
                    Profile
                </a>
                <a href="/" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->is('/')) bg-red-800 text-orange-400 @endif">
                    Data Client
                </a>
                <div class="pt-4 border-t border-red-800 space-y-3">
                    <a href="{{ route('login') }}" 
                       class="block w-full px-4 py-3 text-center text-base font-semibold border-2 border-white rounded-lg hover:bg-white hover:text-red-900 transition-all duration-300">
                        Login
                    </a>
                </div>
            </div>
        </div>
        @endif

        {{-- MOBILE MENU - ADMIN --}}
        @can('admin')
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="md:hidden bg-gradient-to-b from-red-950 to-red-900 shadow-2xl border-t border-red-800"
             @click.away="mobileMenuOpen = false"
             style="display: none;">
            <div class="px-4 py-6 space-y-3">
                <div class="flex items-center gap-3 px-4 py-3 bg-red-800/50 rounded-lg mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                        <span class="text-base font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-red-200">Administrator</p>
                    </div>
                </div>
                <a href="/home#home" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->is('home')) bg-red-800 text-orange-400 @endif">
                    Home
                </a>
                <a href="/home#about" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2">
                    About
                </a>
                <a href="/home#profile" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2">
                    Profile
                </a>
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->routeIs('admin.dashboard')) bg-red-800 text-orange-400 @endif">
                    Dashboard
                </a>
                <a href="{{ route('admin.clients.index') }}" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->routeIs('admin.clients.*')) bg-red-800 text-orange-400 @endif">
                    Manajemen Clients
                </a>
                <a href="{{ route('admin.chat.index') }}" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->routeIs('admin.chat.*')) bg-red-800 text-orange-400 @endif">
                    Manajemen Chat
                </a>
                <div class="pt-4 border-t border-red-800">
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="block w-full px-4 py-3 text-center text-base font-semibold border-2 border-white rounded-lg hover:bg-white hover:text-red-900 transition-all duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endcan

        {{-- MOBILE MENU - CLIENT --}}
        @if(session('client_id'))
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="md:hidden bg-gradient-to-b from-red-950 to-red-900 shadow-2xl border-t border-red-800"
             @click.away="mobileMenuOpen = false"
             style="display: none;">
            <div class="px-4 py-6 space-y-3">
                <div class="flex items-center gap-3 px-4 py-3 bg-red-800/50 rounded-lg mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center">
                        <span class="text-base font-bold">{{ substr(session('client_name'), 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">{{ session('client_name') }}</p>
                        <p class="text-xs text-red-200">Client</p>
                    </div>
                </div>
                <a href="/home#home" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->is('home')) bg-red-800 text-orange-400 @endif">
                    Home
                </a>
                <a href="/home#about" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2">
                    About
                </a>
                <a href="/home#profile" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2">
                    Profile
                </a>
                <a href="{{ route('user.clients.dashboard', session('client_id')) }}" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->routeIs('user.clients.dashboard')) bg-red-800 text-orange-400 @endif">
                    Dashboard
                </a>
                <a href="{{ route('user.clients.show', session('client_id')) }}" 
                   class="block px-4 py-3 text-base font-medium rounded-lg hover:bg-red-800 transition-all duration-300 transform hover:translate-x-2 @if(request()->routeIs('user.clients.show')) bg-red-800 text-orange-400 @endif">
                    Manajemen Progres
                </a>
                <div class="pt-4 border-t border-red-800">
                    <form action="{{ route('user.clients.logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="block w-full px-4 py-3 text-center text-base font-semibold border-2 border-white rounded-lg hover:bg-white hover:text-red-900 transition-all duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </nav>
</header>

<script>
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        document.documentElement.style.setProperty('--scroll-y', `${scrolled * 0.5}px`);
    });
</script>

<style>
    body {
        padding-top: 80px;
    }
    @media (max-width: 768px) {
        body {
            padding-top: 70px;
        }
    }
</style>