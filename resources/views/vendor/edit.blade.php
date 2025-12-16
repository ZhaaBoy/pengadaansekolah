<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Barang Katalog
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-md rounded-2xl">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">✏️ Edit Barang</h3>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('barang.update', $barang->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- KODE BARANG --}}
                <div>
                    <label for="kode_barang" class="block text-sm font-semibold text-gray-600 mb-1">
                        Kode Barang
                    </label>
                    <input type="text" name="kode_barang" id="kode_barang"
                        value="{{ old('kode_barang', $barang->kode_barang) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('kode_barang')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NAMA BARANG --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-semibold text-gray-600 mb-1">
                        Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('nama_barang')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- HARGA --}}
                <div>
                    <label for="harga" class="block text-sm font-semibold text-gray-600 mb-1">
                        Harga Satuan (Rp)
                    </label>
                    <input type="number" name="harga" id="harga" min="0"
                        value="{{ old('harga', $barang->harga) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('harga')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- STOK --}}
                <div>
                    <label for="stok" class="block text-sm font-semibold text-gray-600 mb-1">
                        Stok
                    </label>
                    <input type="number" name="stok" id="stok" min="0"
                        value="{{ old('stok', $barang->stok) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('stok')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- INFORMASI REKENING --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Nama Bank --}}
                    <div>
                        <label for="nama_bank" class="block text-sm font-semibold text-gray-600 mb-1">
                            Nama Bank
                        </label>
                        <input type="text" name="nama_bank" id="nama_bank"
                            value="{{ old('nama_bank', $barang->nama_bank) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: BCA, Mandiri, BSI" required>
                        @error('nama_bank')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Rekening --}}
                    <div>
                        <label for="nama_rekening" class="block text-sm font-semibold text-gray-600 mb-1">
                            Nama Rekening
                        </label>
                        <input type="text" name="nama_rekening" id="nama_rekening"
                            value="{{ old('nama_rekening', $barang->nama_rekening) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        @error('nama_rekening')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor Rekening --}}
                    <div>
                        <label for="no_rekening" class="block text-sm font-semibold text-gray-600 mb-1">
                            Nomor Rekening
                        </label>
                        <input type="text" name="no_rekening" id="no_rekening"
                            value="{{ old('no_rekening', $barang->no_rekening) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        @error('no_rekening')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-4 flex justify-end gap-2">
                    <a href="{{ route('vendor.pengadaan.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 text-white rounded-md text-sm hover:shadow-lg transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
