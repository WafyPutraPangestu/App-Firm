<x-layout>
    <div class="">
        <div class="">
            <h1>Halaman show progres</h1>
        </div>
        <div class="">
            <a href="{{ route('admin.progres.create', ['perkara' => $perkara , 'client' => $client]) }}">create</a>
        </div>
    </div>
    <div class="">
        <p> {{ $perkara->jenis_perkara }} </p>
        <p> {{ $perkara->deskripsi_perkara }} </p>
        <p> {{ $perkara->status }} </p>
        <p> {{ $perkara->tanggal_mulai }} </p>
    </div>
</x-layout>