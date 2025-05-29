<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePegawai extends Component
{
    // Validasi untuk NIP
    #[Validate('required|string|max:10')]
    public string $nip = '';

    // Validasi untuk nama
    #[Validate('required|string|max:50')]
    public string $nama = '';

    // Validasi untuk unit kerja
    #[Validate('required|exists:unit_kerja,id')]
    public $unit_kerja_id = '';

    // Method untuk menyimpan data pegawai
    public function save()
    {
        $this->validate();

        Pegawai::create([
            'nip' => $this->nip,
            'nama' => $this->nama,
            'unit_kerja_id' => $this->unit_kerja_id,
        ]);

        session()->flash('message', 'Pegawai berhasil ditambahkan.');

        $this->redirectRoute('pegawai.index');
    }

    public function render()
    {
        return view('livewire.pegawai.create-pegawai', [
            'unitKerjas' => UnitKerja::all()]);
    }
}