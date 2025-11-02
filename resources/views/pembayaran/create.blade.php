{{-- resources/views/pembayaran/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Pembayaran (Transfer)</h2>
    </x-slot>
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('pembayaran.store') }}" enctype="multipart/form-data"
            class="bg-white p-6 shadow sm:rounded-lg space-y-4">
            @csrf
            <label class="block">Pilih Pengadaan (Menunggu Pembayaran)</label>
            <select name="pengadaan_id" class="w-full border rounded p-2" required x-data
                x-on:change="
              const id = $event.target.value;
              const opt = $event.target.selectedOptions[0];
              document.getElementById('total').innerText = opt.dataset.total;
              document.getElementById('rek_info').innerText = opt.dataset.rekinfo;
            ">
                <option value="" disabled selected>-- pilih --</option>
                @foreach ($pengadaans as $p)
                    @php
                        $d = $p->detail->first();
                        $rekInfo = $d?->nama_vendor . ' | ' . $d?->nama_rekening . ' - ' . $d?->no_rekening;
                    @endphp
                    <option value="{{ $p->id }}"
                        data-total="Rp {{ number_format($p->total_harga, 0, ',', '.') }}"
                        data-rekinfo="{{ $rekInfo }}">
                        #{{ $p->id }} — {{ $d?->barang?->nama_barang }} (Qty {{ $d?->qty }})
                    </option>
                @endforeach
            </select>

            <div class="bg-gray-50 p-3 rounded">
                <div>Total: <span id="total" class="font-semibold">-</span></div>
                <div>Rekening Vendor: <span id="rek_info" class="font-semibold">-</span></div>
            </div>

            <label class="block">Upload Bukti Transfer (jpg/png)</label>
            <input type="file" name="bukti" accept="image/*" class="w-full border rounded p-2" required>

            <x-button>Kirim Pembayaran</x-button>
        </form>
    </div>
</x-app-layout>
