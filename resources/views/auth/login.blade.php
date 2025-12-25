<x-layout>
    <div class="">
        <form action="{{ route('auth.login') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <h1 class="text-center text-3xl">halama login</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-10 md:pl-50 pr-10 md:pr-50 py-10  ">
                <div class="">
                    <img src="{{ Vite::asset('resources/asset/home/bg1.png') }}" alt="" class="rounded-l-2xl">
                </div>
                <div class="flex flex-col gap-4 justify-center">
                    <div class="flex flex-col gap-2">
                        <label for="email" class="uppercase pl-2">Email:</label>
                        <input type="email" id="email" name="email" class="py-2 rounded-2xl border-black border"
                            required>
                    </div>
                    <div class="flex flex-col  gap-2">
                        <label for="password" class="uppercase pl-2">Password:</label>
                        <input type="password" id="password" name="password" required
                            class="border-black border py-2 rounded-2xl">
                    </div>
                    <button type="submit" class="cursor-grab">Login</button>
                </div>
            </div>
    </div>
</x-layout>
