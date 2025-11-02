@props(['data' => []])

<table class="w-full text-sm text-gray-700 border-collapse">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="p-2 text-left">Tanggal</th>
            <th class="p-2 text-left">Barang</th>
            <th class="p-2 text-left">Vendor/Staff</th>
            <th class="p-2 text-right">Total</th>
            <th class="p-2 text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-2">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                <td class="p-2">{{ $item->detail->first()?->barang?->nama_barang }}</td>
                <td class="p-2">{{ $item->staff->name ?? $item->detail->first()?->nama_vendor }}</td>
                <td class="p-2 text-right">Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}</td>
                <td class="p-2 text-center">
                    @php $status = $item->status ?? $item->pembayaran?->is_approved; @endphp
                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold
                        @if ($status == 'approved' || $status == 'selesai') bg-green-100 text-green-700
                        @elseif($status == 'menunggu_pembayaran' || $status == 'pending') bg-yellow-100 text-yellow-700
                        @elseif($status == 'rejected' || $status == 'ditolak') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst(str_replace('_', ' ', $status ?? '-')) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500 italic">
                    Tidak ada data untuk ditampilkan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
