<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditPeminjaman extends Component
{
    // Properti untuk relasi pegawai_id
    #[Validate('required|exists:pegawai,id')]
    public $pegawai_id = '';

    // Properti untuk relasi ruang_id
    #[Validate('required|exists:ruang,id')]
    public $ruang_id = '';

    // Properti untuk tanggal peminjaman
    #[Validate('required|date')]
    public $tanggal = '';

    // Properti untuk jam mulai
    #[Validate('required')]
    public $jam_mulai = '';

    // Properti untuk jam akhir
    #[Validate('required')]
    public $jam_akhir = '';

    // Properti untuk keterangan tambahan (opsional)
    #[Validate('nullable|string')]
    public $keterangan = '';

    // Menyimpan data peminjaman yang sedang diedit
    public Peminjaman $peminjaman;

    /**
     * Fungsi mount digunakan untuk mengisi nilai form dengan data lama dari database
     */
    public function mount(Peminjaman $peminjaman)
    {
        $this->peminjaman = $peminjaman;

        // Isi form input dengan data yang lama dari database
        $this->pegawai_id = $peminjaman->pegawai_id;
        $this->ruang_id = $peminjaman->ruang_id;
        $this->tanggal = $peminjaman->tanggal;
        $this->jam_mulai = $peminjaman->jam_mulai;
        $this->jam_akhir = $peminjaman->jam_akhir;
        $this->keterangan = $peminjaman->keterangan;
    }

    /**
     * Fungsi untuk menyimpan data yang telah diedit
     */
    public function save()
    {
        // Validasi inputan
        $this->validate();

        // Update data ke database
        $this->peminjaman->update([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        // Tampilkan pesan sukses
        session()->flash('message', 'Peminjaman berhasil diperbarui.');

        // Redirect ke halaman list peminjaman
        return redirect()->route('peminjaman.index');
    }

    /**
     * Render komponen edit dengan data pegawai & ruang sebagai dropdown
     */
    public function render()
    {
        return view('livewire.peminjaman.edit-peminjaman', [
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all()]);
    }
}