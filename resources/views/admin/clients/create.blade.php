<x-layout>
<div class="">
    <div class="">
        <h1 class="text-2xl font-bold mb-6">Create New Client</h1>
        <form action="{{ route('admin.clients.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('nama_lengkap') }}">
                @error('nama_lengkap')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                @enderror
            </div>
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="no_hp" id="no_hp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('no_hp') }}">
                @error('no_hp')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                @enderror
            </div>
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="alamat" id="alamat" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('alamat') }}">
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                @enderror
            </div>
            <div>
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" id="nik" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('nik') }}">
                @error('nik')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                @enderror
                </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">Create Client</button>       
            </div>
        </form>
    </div>
</div>
</x-layout>