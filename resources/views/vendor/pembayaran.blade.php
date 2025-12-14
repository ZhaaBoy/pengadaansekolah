<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Pembayaran Vendor
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Card Wrapper --}}
        <div class="bg-white p-6 shadow-md rounded-2xl">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-semibold text-gray-700 text-lg flex items-center gap-2">
                    📦 Daftar Pembayaran Pengadaan
                </h3>
                <span class="text-sm text-gray-500">Total: {{ $pengadaan->count() }} data</span>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-700 border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wide text-gray-600">
                        <tr>
                            <th class="py-2 px-3 text-center">No</th>
                            <th class="py-2 px-3 text-left">Staff</th>
                            <th class="py-2 px-3 text-left">Barang</th>
                            <th class="py-2 px-3 text-center">Qty</th>
                            <th class="py-2 px-3 text-right">Total</th>
                            <th class="py-2 px-3 text-center">Status</th>
                            <th class="py-2 px-3 text-center">Bukti</th>
                            <th class="py-2 px-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($pengadaan as $p)
                            @php
                                $d = $p->detail->firstWhere('barang.user_id', auth()->id());
                                $bukti = $p->pembayaran?->bukti ? asset('storage/' . $p->pembayaran->bukti) : null;
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-3 text-center font-semibold">{{ $loop->iteration }}</td>
                                <td class="py-2 px-3">{{ $p->staff->name }}</td>
                                <td class="py-2 px-3">{{ $d?->barang?->nama_barang }}</td>
                                <td class="py-2 px-3 text-center">{{ $d?->qty }}</td>
                                <td class="py-2 px-3 text-right font-semibold">
                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                </td>

                                {{-- STATUS --}}
                                <td class="py-2 px-3 text-center">
                                    @if ($p->status === 'dibayar')
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">
                                            Menunggu Respon
                                        </span>
                                    @elseif ($p->status === 'dikirim')
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                                            Diproses
                                        </span>
                                    @elseif ($p->status === 'ditolak')
                                        <span
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-semibold">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    @endif
                                </td>


                                {{-- BUKTI --}}
                                <td class="py-2 px-3 text-center">
                                    @if ($bukti)
                                        <a href="{{ $bukti }}" target="_blank">
                                            <img src="{{ $bukti }}"
                                                class="h-12 w-12 object-cover rounded-md shadow-sm mx-auto hover:scale-105 transition-transform">
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="py-2 px-3">
                                    <div class="flex justify-center gap-2">
                                        @if ($p->status === 'dibayar')
                                            <form method="POST" action="{{ route('vendor.pengadaan.approve', $p) }}">
                                                @csrf
                                                <button
                                                    class="px-3 py-1 bg-emerald-600 text-white text-xs rounded-lg hover:bg-emerald-500">
                                                    Terima
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('vendor.pengadaan.reject', $p) }}">
                                                @csrf
                                                <button
                                                    class="px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-500">
                                                    Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500 italic">
                                    Belum ada pembayaran untuk vendor ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
