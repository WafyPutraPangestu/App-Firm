<x-layout>
    <div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-red-800 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-red-900 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
        </div>

        <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
            <div x-data="{ 
                emailFocused: false,
                passwordFocused: false
            }" 
            class="w-full max-w-md">
                
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="text-center pt-10 pb-8 px-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-800 rounded-full mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                Halo Admin Selamat Bekerja
                            </h1>
                            <p class="text-gray-600 text-sm">Please login to your account</p>
                        </div>

                        <div class="px-8 pb-8">
                            
                            <div class="mb-5">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 {{ $errors->has('email') ? 'text-red-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}"
                                           x-ref="email"
                                           @focus="emailFocused = true" 
                                           @blur="emailFocused = false"
                                           placeholder="Enter your email"
                                           class="w-full pl-10 pr-4 py-3 bg-gray-50 border rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all duration-200
                                           {{ $errors->has('email') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300' }}"
                                           :class="emailFocused && !{{ $errors->has('email') ? 'true' : 'false' }} ? 'bg-white shadow-sm' : ''"
                                           >
                                </div>
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 {{ $errors->has('password') ? 'text-red-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                           class="w-full pl-10 pr-4 py-3 bg-gray-50 border rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all duration-200
                                           {{ $errors->has('password') ? 'border-red-500 ring-1 ring-red-500' : 'border-gray-300' }}"
                                           :class="passwordFocused && !{{ $errors->has('password') ? 'true' : 'false' }} ? 'bg-white shadow-sm' : ''"
                                           >
                                </div>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" 
                                    class="w-full py-3 px-6 bg-red-800 hover:bg-red-900 text-white font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-red-800/20 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Login
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>