<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use Livewire\Component;

class ListPegawai extends Component
{
    /**
     * Menampilkan daftar pegawai yang ada di database
     * dan mengirimkan data tersebut ke view.
     * Menggunakan model Pegawai untuk mengambil data pegawai dari database dengan variabel $pegawai
     */
    public function render()
    {
        return view('livewire.pegawai.list-pegawai', [
            'pegawais' => Pegawai::with('unitKerja')->get(),
        ]);
    }

    /**
     * Membuat method untuk menghapus data pegawai
     */
    public function delete($id)
    {
        // Menggunakan model Pegawai untuk mencari data pegawai berdasarkan id yang diberikan
        $pegawai = Pegawai::find($id);

        // Jika data pegawai ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        if ($pegawai) {
            $pegawai->delete();
            session()->flash('message', 'Pegawai berhasil dihapus.');}
    }
}