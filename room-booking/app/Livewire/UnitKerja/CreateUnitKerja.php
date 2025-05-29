<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateUnitKerja extends Component
{
    // Validasi untuk kode unit kerja
    #[Validate('required|string|max:10')]
    public string $kode = '';

    // Validasi untuk nama unit kerja
    #[Validate('required|string|max:100')]
    public string $nama = '';

    // Method untuk menyimpan data unit kerja
    public function save()
    {
        // Validasi input
        $this->validate();

        // Simpan data ke database
        UnitKerja::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
        ]);

        // Flash message sukses
        session()->flash('message', 'Unit Kerja berhasil ditambahkan.');

        // Redirect ke halaman list unit kerja
        $this->redirectRoute('unit-kerja.index');
    }

    public function render()
    {
        return view('livewire.unit-kerja.create-unit-kerja');
    }
}
