<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Buat Pengadaan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('pengadaan.store') }}" class="bg-white p-6 shadow-md rounded-2xl space-y-5"
            x-data="pengadaanForm()">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih Barang</label>
                <select name="barang_id" id="barangSelect" class="w-full border-gray-300 rounded-lg p-2 text-sm" required
                    x-on:change="setBarang($event)">
                    <option value="" disabled selected>-- pilih barang --</option>
                    @foreach ($barangs as $b)
                        <option value="{{ $b->id }}" data-harga="{{ $b->harga }}"
                            data-vendor="{{ $b->vendor->name }}" data-namarek="{{ $b->nama_rekening }}"
                            data-norek="{{ $b->no_rekening }}">
                            {{ $b->nama_barang }} — Rp {{ number_format($b->harga, 0, ',', '.') }}
                            ({{ $b->vendor->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Qty</label>
                <input type="number" name="qty" min="1"
                    class="w-full border-gray-300 rounded-lg p-2 text-sm" x-model="qty" @input="hitungTotal()"
                    placeholder="Masukkan jumlah..." required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Satuan</label>
                    <input x-model="hargaFormatted" id="harga"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Total Harga</label>
                    <input x-model="totalFormatted" id="total"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm font-semibold text-green-700"
                        disabled>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Vendor</label>
                    <input x-model="vendor" id="nama_vendor"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Rekening</label>
                    <input x-model="namaRekening" id="nama_rekening"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No Rekening</label>
                    <input x-model="noRekening" id="no_rekening"
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-50 text-sm" disabled>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit"
                    class="px-5 py-2 bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 text-white rounded-md text-sm hover:shadow-lg transition">
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
                vendor: '',
                namaRekening: '',
                noRekening: '',

                setBarang(e) {
                    const opt = e.target.selectedOptions[0];
                    this.harga = parseInt(opt.dataset.harga);
                    this.vendor = opt.dataset.vendor;
                    this.namaRekening = opt.dataset.namarek;
                    this.noRekening = opt.dataset.norek;
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
