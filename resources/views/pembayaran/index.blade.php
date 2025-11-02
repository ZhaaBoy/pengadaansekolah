{{-- resources/views/pembayaran/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Pembayaran Pengadaan
        </h2>
    </x-slot>

    <div class="py-6 px-6 lg:px-10">
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
                            <th class="py-3 px-4 text-left font-semibold">Tanggal Pembayaran</th>
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
                        @forelse ($pembayaran as $bayar)
                            @php
                                $p = $bayar->pengadaan;
                                $detail = $p->detail->first();
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-center text-gray-600">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-left text-gray-600">
                                    {{ \Carbon\Carbon::parse($p->updated_at)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="py-3 px-4 font-medium text-gray-800">{{ $detail?->barang?->nama_barang }}
                                </td>
                                <td class="py-3 px-4 text-gray-700">{{ $detail?->nama_vendor }}</td>
                                <td class="py-3 px-4 text-right font-semibold">
                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if ($bayar->is_approved == 'approved')
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">Disetujui</span>
                                    @elseif ($bayar->is_approved == 'rejected')
                                        <span
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">Ditolak</span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">Menunggu</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if ($bayar->bukti)
                                        <a href="{{ asset('storage/' . $bayar->bukti) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $bayar->bukti) }}"
                                                class="h-14 w-14 object-cover rounded-md border border-gray-200 mx-auto hover:scale-105 transition-transform duration-200">
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">Belum diupload</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if ($bayar->invoice_path)
                                        <a href="{{ asset('storage/' . $bayar->invoice_path) }}" target="_blank"
                                            class="text-blue-600 hover:underline text-sm">Lihat Invoice</a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if (!$bayar->bukti && $p->status == 'menunggu_pembayaran')
                                        <button x-data @click="$dispatch('open-modal', { id: {{ $bayar->id }} })"
                                            class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs">
                                            Upload Bukti
                                        </button>
                                    @else
                                        <span class="text-gray-300 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>

                            {{-- Modal Upload --}}
                            <div x-data="{ open: false }"
                                x-on:open-modal.window="if($event.detail.id == {{ $bayar->id }}) open = true">
                                <div x-show="open"
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                    x-transition>
                                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6"
                                        @click.away="open = false">
                                        <h2 class="text-lg font-semibold mb-4 text-gray-700">Upload Bukti Transfer</h2>
                                        <p class="text-sm text-gray-600 mb-2">
                                            <strong>Nama Rekening:</strong> {{ $detail?->nama_rekening }}<br>
                                            <strong>No. Rekening:</strong> {{ $detail?->no_rekening }}
                                        </p>

                                        <form method="POST" action="{{ route('pembayaran.store') }}"
                                            enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            <input type="hidden" name="pengadaan_id" value="{{ $p->id }}">
                                            <input type="file" name="bukti" accept="image/*"
                                                class="border border-gray-300 rounded-md p-2 w-full text-sm" required>

                                            <div class="flex justify-end gap-2">
                                                <button type="button" @click="open = false"
                                                    class="px-3 py-1 bg-gray-300 text-gray-700 rounded-md text-xs hover:bg-gray-400">
                                                    Batal
                                                </button>
                                                <button type="submit"
                                                    class="px-3 py-1 bg-blue-600 text-white rounded-md text-xs hover:bg-blue-700">
                                                    Upload
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500 italic">
                                    Tidak ada data pembayaran untuk saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
