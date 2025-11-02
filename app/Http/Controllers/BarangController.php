<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = auth()->user()->barangs()->latest()->paginate(10);
        return view('barang.index', compact('barangs'));
    }
    public function create()
    {
        return view('vendor.create');
    }
    public function store(Request $r)
    {
        $v = $r->validate([
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'harga' => 'required|numeric|min:0',
            'nama_bank' => 'required',
            'nama_rekening' => 'required',
            'no_rekening' => 'required'
        ]);
        $v['user_id'] = auth()->id();
        \App\Models\Barang::create($v);
        return redirect()->route('vendor.pengadaan.index')->with('success', 'Barang ditambah');
    }
    public function edit($id)
    {
        $barang = Barang::where('user_id', auth()->id())->findOrFail($id);
        return view('vendor.edit', compact('barang'));
    }

    public function update(Request $r, $id)
    {
        $barang = Barang::where('user_id', auth()->id())->findOrFail($id);

        $r->validate([
            'kode_barang' => 'required|string|max:50|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'nama_bank' => 'required|string|max:100',
            'nama_rekening' => 'required|string|max:100',
            'no_rekening' => 'required|string|max:100',
        ]);

        $barang->update([
            'kode_barang' => strtoupper($r->kode_barang),
            'nama_barang' => $r->nama_barang,
            'harga' => $r->harga,
            'nama_bank' => $r->nama_bank,
            'nama_rekening' => $r->nama_rekening,
            'no_rekening' => $r->no_rekening,
        ]);

        return redirect()->route('vendor.pengadaan.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $this->authorizeVendor($barang);
        $barang->delete();
        return back()->with('success', 'Dihapus');
    }
    private function authorizeVendor(Barang $b)
    {
        abort_if($b->user_id !== auth()->id(), 403);
    }
}
