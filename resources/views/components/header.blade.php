<header>
    <nav class="bg-red-900 text-white">
        <div class="flex items-center justify-between px-4 py-2">
            <div class="">
                <img src="{{ Vite::asset('resources/asset/home/logo-ats.png') }}" alt="" class="h-20">
            </div>
            <div class="flex space-x-6 ">
                <p><a href="/">Home</a></p>
                <p><a href="#">About</a></p>
                <p><a href="#">Profile</a></p>
                <p><a href="#">Contact</a></p>
            </div>
            <div class="flex gap-4">
                <p><a href="{{ route('auth.login') }}">Login</a></p>
                <p><a href="{{ route('auth.register') }}">Register</a></p>
            </div>
        </div>
    </nav>
</header>
