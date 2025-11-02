{{-- resources/views/invoice/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Invoice Lunas</h2>
    </x-slot>
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow sm:rounded-lg">
        <div class="text-2xl font-bold mb-1">INVOICE</div>
        <div class="text-sm text-gray-500 mb-6">Status: LUNAS</div>
        <div><b>No:</b> INV-{{ $pengadaan->id }}</div>
        <div><b>Tanggal:</b> {{ $pengadaan->created_at->format('d/m/Y') }}</div>
        <hr class="my-3">
        @php $d = $pengadaan->detail->first(); @endphp
        <div><b>Staff:</b> {{ $pengadaan->staff->name }}</div>
        <div><b>Vendor:</b> {{ $d?->nama_vendor }}</div>
        <div class="mt-3">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td>{{ $d?->barang?->nama_barang }}</td>
                        <td>{{ $d?->qty }}</td>
                        <td>Rp {{ number_format($d?->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($d?->subtotal, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tfoot class="border-t">
                    <tr>
                        <td colspan="3" class="text-right font-semibold p-2">Total</td>
                        <td class="font-semibold">Rp {{ number_format($pengadaan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>
