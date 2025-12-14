<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Approval Pengadaan
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">
                📋 Pengadaan Menunggu Approval
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm text-gray-700">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wide text-gray-600">
                        <tr>
                            <th class="py-3 px-4 text-left">Tanggal Pengadaan</th>
                            <th class="py-3 px-4 text-left">Staff</th>
                            <th class="py-3 px-4 text-left">Barang</th>
                            <th class="py-3 px-4 text-left">Vendor</th>
                            <th class="py-3 px-4 text-center">Qty</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-left">Total</th>
                            <th class="py-3 px-4 text-center">invoice</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pengadaan as $p)
                            @php $d = $p->detail->first(); @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-left">
                                    {{ \Carbon\Carbon::parse($d?->created_at)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="py-3 px-4">{{ $p->staff->name }}</td>
                                <td class="py-3 px-4 font-medium">{{ $d?->barang?->nama_barang }}</td>
                                <td class="py-3 px-4">{{ $d?->nama_vendor }}</td>
                                <td class="py-3 px-4 text-center">{{ $d?->qty }}</td>
                                <td class="py-3 px-4 text-center">
                                    @php $status = $p->status; @endphp

                                    @if ($status === 'menunggu_approval')
                                        <span
                                            class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-semibold">
                                            Menunggu Approval
                                        </span>
                                    @elseif ($status === 'menunggu_pembayaran')
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                            Menunggu Pembayaran
                                        </span>
                                    @elseif ($status === 'dibayar')
                                        <span
                                            class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">
                                            Dibayar
                                        </span>
                                    @elseif ($status === 'dikirim')
                                        <span
                                            class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                            Dikirim
                                        </span>
                                    @elseif ($status === 'selesai')
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                            Selesai
                                        </span>
                                    @elseif ($status === 'ditolak')
                                        <span
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="py-3 px-4 text-left font-semibold">
                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if ($p->pembayaran && $p->pembayaran->invoice_path)
                                        <a href="{{ asset('storage/' . $p->pembayaran->invoice_path) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-semibold hover:bg-indigo-200">Lihat
                                            Invoice</a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif

                                    {{-- @if ($p->pembayaran && $p->pembayaran->invoice_path)
                                        <a href="{{ route('vendor.invoice.preview', $p->id) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-semibold hover:bg-indigo-200">
                                            🔍 Preview Invoice
                                        </a>
                                    @endif --}}
                                </td>
                                @if ($status === 'menunggu_approval')
                                    <td class="py-3 px-4">
                                        <div class="flex justify-center gap-2">


                                            <form method="POST" action="{{ route('kepsek.pengadaan.approve', $p) }}">
                                                @csrf
                                                <button
                                                    class="px-3 py-1 bg-emerald-600 text-white text-xs rounded-lg hover:bg-emerald-500">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('kepsek.pengadaan.reject', $p) }}">
                                                @csrf
                                                <button
                                                    class="px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-500">
                                                    Tolak
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                @else
                                    <td class="py-3 px-4 text-center">-</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-gray-500 italic">
                                    Tidak ada pengadaan menunggu approval.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
