<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;

class ListUnitKerja extends Component
{
    /**
     * Menampilkan daftar unit kerja yang ada di database
     * dan mengirimkan data tersebut ke view.
     * Menggunakan model UnitKerja untuk mengambil data unit kerja dari database dengan variabel $unitKerjas
     */
    public function render()
    {
        return view('livewire.unit-kerja.list-unit-kerja', [
            'unitKerjas' => UnitKerja::all(),
        ]);
    }

    /**
     * Membuat method untuk menghapus data unit kerja
     */
    public function delete($id)
    {
        // Menggunakan model UnitKerja untuk mencari data unit kerja berdasarkan id yang diberikan
        $unitKerja = UnitKerja::find($id);

        // Jika data unit kerja ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        if ($unitKerja) {
            $unitKerja->delete();
            session()->flash('message', 'Unit kerja berhasil dihapus.');}
    }
}