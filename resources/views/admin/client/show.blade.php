<x-layout>
    {{-- @dd($client->nama_lengkap) --}}
    <header>
        <div class="">
            <h2 class="">
                {{ $client->nama_lengkap }}
            </h2>
        </div>
        <div class="">
            <a href="{{ route('admin.perkara.create', $client) }}">Create Perkara</a>
        </div>
    </header>
    <div class="">
        <div class=" flex justify-between items-center mb-6 p-6 bg-white border border-gray-200 rounded-lg shadow-sm ">
            <p class="">
                <span class="">Nama Lengkap:</span> {{ $client->nama_lengkap }}
            </p>
            <p class="">
                <span class="">Email:</span> {{ $client->email }}
            </p>
            <p class="">
                <span class="">No. Telepon:</span> {{ $client->no_hp }}
            </p>
            <p class="">
                <span class="">Alamat:</span> {{ $client->alamat }}
            </p>
            <p class="">
                <span class="">Perusahaan:</span> {{ $client->nama_perusahaan }}
            </p>
            <p class="">
                <span class="">Status:</span> {{ $client->status }}
            </p>
            <p>
                <span class="">Jenis Client:</span> {{ $client->jenis_client }}
            </p>
        </div>
    </div>
</x-layout>
