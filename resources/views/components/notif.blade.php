<div aria-live="assertive" class="fixed top-5 right-5 z-50 flex flex-col gap-3 w-full max-w-sm pointer-events-none">
    
    @if (session('success'))
    <div x-data="{ show: true, width: '100%' }"
         x-init="setTimeout(() => width = '0%', 100); setTimeout(() => show = false, 4000)"
         x-show="show"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="pointer-events-auto relative w-full bg-white rounded-lg shadow-xl border-l-4 border-green-600 overflow-hidden ring-1 ring-black ring-opacity-5">
        
        <div class="p-4 flex items-start gap-3">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 w-0">
                <p class="text-sm font-bold text-gray-900">Berhasil!</p>
                <p class="mt-1 text-sm text-gray-600">{{ session('success') }}</p>
            </div>
            <div class="flex-shrink-0 flex">
                <button @click="show = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-1 bg-green-600 transition-all ease-linear duration-[3900ms]" :style="`width: ${width}`"></div>
    </div>
    @endif

    @if (session('error') || $errors->any())
    <div x-data="{ show: true, width: '100%' }"
         x-init="setTimeout(() => width = '0%', 100); setTimeout(() => show = false, 5000)"
         x-show="show"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="pointer-events-auto relative w-full bg-white rounded-lg shadow-xl border-l-4 border-red-800 overflow-hidden ring-1 ring-black ring-opacity-5">
        
        <div class="p-4 flex items-start gap-3">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 w-0">
                <p class="text-sm font-bold text-red-800">Perhatian</p>
                <div class="mt-1 text-sm text-gray-600">
                    @if(session('error'))
                        {{ session('error') }}
                    @else
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="flex-shrink-0 flex">
                <button @click="show = false" class="text-gray-400 hover:text-red-800 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-1 bg-red-800 transition-all ease-linear duration-[4900ms]" :style="`width: ${width}`"></div>
    </div>
    @endif

</div>