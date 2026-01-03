<x-layout>
    {{-- @dd($client->nama_lengkap) --}}
    <header class="mb-6 flex items-center justify-between container mx-auto px-6 py-5">
        <div class="">
            <h2 class="">
                {{ Auth::user()->name }}
            </h2>
        </div>
        <div class="px-10 text-white bg-blue-500 shadow-xl rounded-xl py-10">
            {{-- @dd($countClients) --}}
            <h1>Jumlah Client</h1>
            <h2>{{ $countClients }}</h2>
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
    <div class="">
        <h2 class="mb-4 text-2xl font-semibold">Daftar Perkara</h2>
        @foreach ($client->perkara as $perkara )
        <a href="{{ route('admin.perkara.show', ['client' => $client , 'perkara' => $perkara]) }}">show</a>
            <p>{{$perkara->jenis_perkara}}</p>
            <p> {{ $perkara->deskripsi_perkara }} </p>
            <p> {{ $perkara->status }} </p>
            <p> {{ $perkara->tanggal_mulai }} </p>
        @endforeach
    </div>
</x-layout>
