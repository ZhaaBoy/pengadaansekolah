<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Pembayaran Pengadaan
        </h2>
    </x-slot>

    <div class="py-6 px-6 lg:px-10" x-data="{ open: false, selectedId: null }"
        x-on:open-modal.window="selectedId = $event.detail.id; open = true">

        <div class="bg-white shadow-md rounded-2xl p-6">

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

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-700">📋 Daftar Pembayaran</h3>
                <span class="text-sm text-gray-500">Total: {{ $pembayaran->count() }} data</span>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full text-sm text-gray-700 border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-left font-semibold">No</th>
                            <th class="py-3 px-4 text-left font-semibold">Tanggal</th>
                            <th class="py-3 px-4 text-left font-semibold">Barang</th>
                            <th class="py-3 px-4 text-left font-semibold">Vendor</th>
                            <th class="py-3 px-4 text-right font-semibold">Total</th>
                            <th class="py-3 px-4 text-center font-semibold">Status</th>
                            <th class="py-3 px-4 text-center font-semibold">Bukti Transfer</th>
                            <th class="py-3 px-4 text-center font-semibold">Invoice</th>
                            <th class="py-3 px-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pembayaran as $p)
                            @php
                                $detail = $p->detail->first();
                                $bayar = $p->pembayaran;
                            @endphp

                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-center text-gray-600">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="py-3 px-4 text-left text-gray-600">
                                    {{ \Carbon\Carbon::parse($p->updated_at)->translatedFormat('l, d F Y') }}
                                </td>

                                <td class="py-3 px-4 font-medium text-gray-800">
                                    {{ $detail?->barang?->nama_barang }}
                                </td>

                                <td class="py-3 px-4 text-gray-700">
                                    {{ $detail?->nama_vendor }}
                                </td>

                                <td class="py-3 px-4 text-right font-semibold">
                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                </td>

                                {{-- STATUS --}}
                                <td class="py-3 px-4 text-center">
                                    @if ($p->status === 'menunggu_pembayaran')
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">
                                            Menunggu Pembayaran
                                        </span>
                                    @elseif ($p->status === 'dibayar')
                                        <span
                                            class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
                                            Menunggu Konfirmasi Vendor
                                        </span>
                                    @elseif ($p->status === 'dikirim')
                                        <span
                                            class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-xs font-semibold">
                                            Dikirim
                                        </span>
                                    @elseif ($p->status === 'selesai')
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                                            Selesai
                                        </span>
                                    @elseif ($p->status === 'ditolak')
                                        <span
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                            {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                                        </span>
                                    @endif
                                </td>

                                {{-- BUKTI --}}
                                <td class="py-3 px-4 text-center">
                                    @if ($bayar && $bayar->bukti)
                                        <a href="{{ asset('storage/' . $bayar->bukti) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $bayar->bukti) }}"
                                                class="h-14 w-14 object-cover rounded-md border border-gray-200 mx-auto hover:scale-105 transition-transform duration-200">
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">Belum diupload</span>
                                    @endif
                                </td>

                                {{-- INVOICE --}}
                                <td class="py-3 px-4 text-center">
                                    @if ($bayar && $bayar->invoice_path)
                                        <a href="{{ asset('storage/' . $bayar->invoice_path) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-semibold hover:bg-indigo-200">
                                            Lihat Invoice
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="py-3 px-4 text-center">
                                    @if ($p->status === 'menunggu_pembayaran')
                                        <button @click="$dispatch('open-modal', { id: {{ $p->id }} })"
                                            class="px-3 py-1 bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 text-white rounded-md hover:shadow-lg hover:scale-105 transition text-xs">
                                            Upload Bukti
                                        </button>
                                    @else
                                        <span class="text-gray-300 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-6 text-gray-500 italic">
                                    Tidak ada data pembayaran untuk saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL --}}
        <div x-show="open" x-cloak
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-transition>

            <div class="bg-white/90 border border-purple-200 rounded-2xl shadow-2xl max-w-md w-full p-6 relative animate-fadeIn"
                @click.away="open = false">

                <button @click="open = false"
                    class="absolute top-3 right-3 text-gray-400 hover:text-purple-600 transition">
                    ✕
                </button>

                <h2 class="text-xl font-bold text-purple-700 mb-4 text-center">
                    Upload Bukti Transfer
                </h2>

                @foreach ($pembayaran as $p)
                    @php
                        $detail = $p->detail->first();
                    @endphp

                    <div x-show="selectedId == {{ $p->id }}" x-transition>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 mb-3 text-sm text-gray-700">
                            <p><strong>Nama Rekening:</strong> {{ $detail?->nama_rekening }}</p>
                            <p><strong>Nama Bank:</strong> {{ $detail?->barang->nama_bank }}</p>
                            <p><strong>No. Rekening:</strong> {{ $detail?->no_rekening }}</p>
                        </div>

                        <form method="POST" action="{{ route('pembayaran.store') }}" enctype="multipart/form-data"
                            class="space-y-4">

                            @csrf
                            <input type="hidden" name="pengadaan_id" value="{{ $p->id }}">

                            <input type="file" name="bukti" accept="image/*"
                                class="border border-purple-300 focus:ring-purple-500 focus:border-purple-500 rounded-md p-2 w-full text-sm"
                                required>

                            <div class="flex justify-end gap-2 mt-4">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm hover:bg-gray-300 transition">
                                    Batal
                                </button>

                                <button type="submit"
                                    class="px-4 py-2 bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 text-white rounded-md text-sm hover:shadow-lg transition">
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] {
        display: none !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.25s ease-out;
    }
</style>
