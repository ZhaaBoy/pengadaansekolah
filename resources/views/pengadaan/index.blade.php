<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengadaan Barang
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-700">📦 Daftar Pengadaan</h3>
                <a href="{{ route('pengadaan.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                    + Tambah Pengadaan
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm text-gray-700">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wide text-gray-600">
                        <tr>
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4 text-center">Tanggal Pengadaan</th>
                            <th class="py-3 px-4 text-left">Barang</th>
                            <th class="py-3 px-4 text-left">Vendor</th>
                            <th class="py-3 px-4 text-center">Qty</th>
                            <th class="py-3 px-4 text-right">Total</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-center">Invoice</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($list as $p)
                            @php $d = $p->detail->first(); @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center">
                                    {{ \Carbon\Carbon::parse($d?->created_at)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="py-3 px-4 font-medium text-gray-800">{{ $d?->barang?->nama_barang }}</td>
                                <td class="py-3 px-4">{{ $d?->nama_vendor }}</td>
                                <td class="py-3 px-4 text-center">{{ $d?->qty }}</td>
                                <td class="py-3 px-4 text-right font-semibold">Rp
                                    {{ number_format($p->total_harga, 0, ',', '.') }}</td>

                                {{-- STATUS --}}
                                <td class="py-3 px-4 text-center">
                                    @if ($p->pembayaran && $p->pembayaran->is_approved == 'approved')
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">Disetujui</span>
                                    @elseif ($p->pembayaran && $p->pembayaran->is_approved == 'rejected')
                                        <span
                                            class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">Ditolak</span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">Menunggu</span>
                                    @endif
                                </td>

                                {{-- INVOICE --}}
                                <td class="py-3 px-4 text-center">
                                    @if ($p->pembayaran && $p->pembayaran->invoice_path)
                                        <a href="{{ asset('storage/' . $p->pembayaran->invoice_path) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-semibold hover:bg-indigo-200">Lihat</a>
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

                                {{-- AKSI --}}
                                <td class="py-3 px-4">
                                    <div class="flex justify-center items-center gap-2">
                                        {{-- Tombol Selesai hanya muncul jika status dikirim --}}
                                        @if ($p->status == 'dikirim')
                                            <form action="{{ route('pengadaan.selesai', $p) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1 bg-emerald-700 text-white text-xs font-semibold rounded-lg hover:bg-emerald-500">
                                                    Selesai
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
                                <td colspan="8" class="py-6 text-center text-gray-500 italic">
                                    Tidak ada data pengadaan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $list->links() }}</div>
        </div>
    </div>
</x-app-layout>
