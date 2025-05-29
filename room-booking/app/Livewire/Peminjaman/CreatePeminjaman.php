<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePeminjaman extends Component
{
    // Properti untuk input pegawai_id (relasi ke tabel pegawai)
    #[Validate('required|exists:pegawai,id')] // Validasi bahwa input harus ada dan merupakan ID yang valid di tabel pegawai
    public $pegawai_id = '';

    // Properti untuk input ruang_id (relasi ke tabel ruang)
    #[Validate('required|exists:ruang,id')] // Validasi bahwa input harus ada dan ID tersebut harus ada di tabel ruang
    public $ruang_id = '';

    // Properti untuk input tanggal peminjaman
    #[Validate('required|date')] // Harus berupa tanggal valid
    public $tanggal = '';

    // Properti untuk jam mulai
    #[Validate('required')] // Harus diisi
    public $jam_mulai = '';

    // Properti untuk jam akhir
    #[Validate('required')] // Harus diisi
    public $jam_akhir = '';

    // Properti opsional untuk keterangan peminjaman
    #[Validate('nullable|string')] // Boleh kosong, tapi kalau diisi harus berupa string
    public $keterangan = '';

    /**
     * Method untuk menyimpan data peminjaman ke database
     */
    public function save()
    {
        // Validasi semua input berdasarkan aturan yang sudah ditentukan di atas
        $this->validate();

        // Simpan data ke database menggunakan model Peminjaman
        Peminjaman::create([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        // Tampilkan pesan sukses
        session()->flash('message', 'Peminjaman berhasil ditambahkan.');

        // Redirect ke halaman list peminjaman
        $this->redirectRoute('peminjaman.index');
    }

    /**
     * Method untuk me-render komponen dan mengirim data ke view
     */
    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman', [
            // Kirim data pegawai dan ruang untuk digunakan di dropdown pilihan
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
        ]);
    }
}