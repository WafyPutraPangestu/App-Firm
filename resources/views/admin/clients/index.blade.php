<x-layout>
    <div class="mb-6">
        <header class="mb-6">
            <div class=" px-4 sm:px-6 lg:px-8 shadow-md py-8 flex justify-between items-center bg-white ">
                <div class="">
                    <h1 class=" container mx-auto text-3xl font-bold text-gray-800">Client List</h1>
                </div>
                <div class="">
                    <a href="{{ route('admin.clients.create') }}"
                        class="relative px-5 py-3 bg-red-200 text-sm lg:text-base font-medium transition-all duration-300 group overflow-hidden rounded-lg">
                        <span class="relative z-10 group-hover:text-red-100 transition-colors duration-300">Create New
                            Clients</span>
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-orange-400 to-red-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                </div>
            </div>
        </header>
        <div class=" px-4 sm:px-6 lg:px-8 py-10">
            <div class="py-10 ">
                <table class="w-full container mx-auto bg-white rounded-lg shadow-md  ">
                    <thead>
                        <tr class="border-b border-gray-200/50 ">
                            <th class=" px-4 py-2">ID</th>
                            <th class=" px-4 py-2">Full Name</th>
                            <th class=" px-4 py-2">Email</th>
                            <th class=" px-4 py-2">Phone Number</th>
                            <th class=" px-4 py-2">Address</th>
                            <th class=" px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($user->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center px-4 py-6">Tidak Mempunyai Data Silahkan Masukan
                                    Data Client.</td>
                            </tr>
                        @else
                            @foreach ($user as $client)
                                <tr class="text-center px-4 py-2">
                                    <td class=" px-4 py-2">{{ $client->id }}</td>
                                    <td class=" px-4 py-2">{{ $client->nama_lengkap }}</td>
                                    <td class=" px-4 py-2">{{ $client->email }}</td>
                                    <td class=" px-4 py-2">{{ $client->no_hp }}</td>
                                    <td class=" px-4 py-2">{{ $client->alamat }}</td>
                                    <td class=" px-4 py-2">
                                        <a href="{{ Route('admin.clients.show', $client) }}"
                                            class="text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('admin.clients.edit', $client) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:underline ml-2">Delete</button>
                                        </form>
                                </tr>
                            @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</x-layout>
