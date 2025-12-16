<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Buat Pengadaan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('pengadaan.store') }}" class="bg-white p-6 shadow-md rounded-2xl space-y-5"
            x-data="pengadaanForm()">
            @csrf

            {{-- PILIH BARANG --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih Barang</label>
                <select name="barang_id" id="barangSelect" class="w-full border-gray-300 rounded-lg p-2 text-sm" required
                    x-on:change="setBarang($event)">
                    <option value="" disabled selected>-- pilih barang --</option>
                    @foreach ($barangs as $b)
                        <option value="{{ $b->id }}" data-harga="{{ $b->harga }}"
                            data-stok="{{ $b->stok }}" data-vendor="{{ $b->vendor->name }}"
                            data-namabank="{{ $b->nama_bank }}" data-namarek="{{ $b->nama_rekening }}"
                            data-norek="{{ $b->no_rekening }}">
                            {{ $b->nama_barang }}
                            — Rp {{ number_format($b->harga, 0, ',', '.') }}
                            (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- JUMLAH QTY --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Qty</label>
                <input type="number" name="qty" min="1"
                    class="w-full border-gray-300 rounded-lg p-2 text-sm" x-model="qty" @input="hitungTotal()"
                    placeholder="Masukkan jumlah..." required>

                <p x-show="qty > stok && stok > 0" x-transition class="mt-1 text-sm text-red-600 font-medium">
                    Stok tidak mencukupi. Stok tersedia hanya <span class="font-bold" x-text="stok"></span>.
                </p>
            </div>

            {{-- DETAIL BARANG --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Satuan</label>
                    <input x-model="hargaFormatted"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm text-right" disabled>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Total Harga</label>
                    <input x-model="totalFormatted"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm font-semibold text-green-700 text-right"
                        disabled>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok Tersedia</label>
                    <input x-model="stok"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm font-semibold text-blue-700 text-left"
                        disabled>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Vendor</label>
                <input x-model="vendor" id="nama_vendor"
                    class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
            </div>

            {{-- REKENING INFO (3 kolom sejajar) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Bank</label>
                    <input x-model="namaBank" id="nama_bank"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Rekening</label>
                    <input x-model="namaRekening" id="nama_rekening"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No Rekening</label>
                    <input x-model="noRekening" id="no_rekening"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="pt-4 flex justify-end">
                <button type="submit" :disabled="qty > stok || stok === 0"
                    :class="(qty > stok || stok === 0) ?
                    'bg-gray-300 cursor-not-allowed' :
                    'bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 hover:shadow-lg'"
                    class="px-5 py-2 text-white rounded-md text-sm transition">
                    Simpan Pengadaan
                </button>
            </div>
        </form>
    </div>

    {{-- Script Alpine.js --}}
    <script>
        function pengadaanForm() {
            return {
                harga: 0,
                qty: 1,
                total: 0,
                stok: 0,

                vendor: '',
                namaBank: '',
                namaRekening: '',
                noRekening: '',

                setBarang(e) {
                    const opt = e.target.selectedOptions[0];

                    this.harga = parseInt(opt.dataset.harga);
                    this.stok = parseInt(opt.dataset.stok);

                    this.vendor = opt.dataset.vendor;
                    this.namaBank = opt.dataset.namabank;
                    this.namaRekening = opt.dataset.namarek;
                    this.noRekening = opt.dataset.norek;

                    this.qty = 1;
                    this.hitungTotal();
                },

                hitungTotal() {
                    this.total = this.harga * this.qty;
                },

                get hargaFormatted() {
                    return this.harga > 0 ? this.formatRupiah(this.harga) : '-';
                },

                get totalFormatted() {
                    return this.total > 0 ? this.formatRupiah(this.total) : '-';
                },

                formatRupiah(angka) {
                    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }
        }
    </script>
</x-app-layout>
