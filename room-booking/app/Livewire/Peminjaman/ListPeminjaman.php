<?php

namespace App\Livewire\Peminjaman;
use App\Models\Ruang;
use App\Models\Pegawai;
use App\Models\Peminjaman;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ListPeminjaman extends Component
{
    /**
     * Menampilkan daftar peminjaman yang ada di database
     * dan mengirimkan data tersebut ke view.
     * Menggunakan model Peminjaman untuk mengambil data peminjaman dari database dengan variabel $peminjaman
     */
    public function render()
    {
        return view('livewire.peminjaman.list-peminjaman', [
            'peminjamans' => Peminjaman::with(['pegawai', 'ruang'])->get(),
        ]);
    }

    /**
     * Membuat method untuk menghapus data peminjaman
     */
    public function delete($id)
    {
        // Menggunakan model Peminjaman untuk mencari data Peminjaman berdasarkan id yang diberikan
        $peminjaman = Peminjaman::find($id);

        // Jika data peminjaman ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        if ($peminjaman) {
            $peminjaman->delete();
            session()->flash('message', 'Peminjaman berhasil dihapus.');}
    }
}