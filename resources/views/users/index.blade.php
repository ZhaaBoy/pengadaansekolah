<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola User
        </h2>
    </x-slot>

    <div class="py-6 px-6 lg:px-10">
        <div class="bg-white shadow-md rounded-2xl p-6">
            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-700">👥 Daftar User</h3>
                <button @click="open = true" x-data="{ open: false }"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition"
                    @click.prevent="$dispatch('open-modal', { id: 'create-user-modal' })">
                    + Tambah User
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm text-gray-700">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wide text-gray-600">
                        <tr>
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4 text-left">Nama</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-center">Role</th>
                            <th class="py-3 px-4 text-center">Tanggal Dibuat</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 font-medium text-gray-800">{{ $user->name }}</td>
                                <td class="py-3 px-4">{{ $user->email }}</td>
                                <td class="py-3 px-4 text-center capitalize">{{ $user->role }}</td>
                                <td class="py-3 px-4 text-center">
                                    {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('Hapus user ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-lg hover:bg-red-200">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500 italic">
                                    Belum ada user terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Create User --}}
    <div x-data="{ open: false }" x-on:open-modal.window="if($event.detail.id === 'create-user-modal') open = true">
        <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition>
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6" @click.away="open = false">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Tambah User Baru</h2>

                <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama</label>
                        <input type="text" name="name" required
                            class="w-full border rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full border rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Role</label>
                        <select name="role" required
                            class="w-full border rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:outline-none">
                            <option value="" disabled selected>-- pilih role --</option>
                            <option value="staff">Staff</option>
                            <option value="vendor">Vendor</option>
                            <option value="kepala_sekolah">Kepala Sekolah</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" @click="open = false"
                            class="px-3 py-1 bg-gray-300 text-gray-700 rounded-md text-xs hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-3 py-1 bg-indigo-600 text-white rounded-md text-xs hover:bg-indigo-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
