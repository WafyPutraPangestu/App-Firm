<x-layout>
    {{-- @dd($client) --}}
    <header>
        <div class="">
            <h1>Halaman Create</h1>
        </div>
        <h1>{{ $client }}</h1>
    </header>
    <div class="">
        <form action="">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client }}">
            <div class="">
                <div class="">
                    <label for="nama_perkara" class="">Nama Perkara</label>
                    <input type="text" name="nama_perkara" id="nama_perkara"
                        class="border border-gray-300 rounded-md shadow-sm p-2 w-full">
                </div>
                <div class="">
                    <label for="deskripsi" class="">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class=" border"></textarea>
                </div>
                <div class="">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</x-layout>
