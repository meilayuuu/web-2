<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Pegawai {{ $pegawai->nip }}</h1>

    <form wire:submit.prevent="save" class="space-y-4">
        <flux:input
            type="text"
            id="nip"
            wire:model.defer="nip"
            label="NIP"
            placeholder="Masukkan NIP Pegawai"
            required
        />

        <flux:input
            type="text"
            id="nama"
            wire:model.defer="nama"
            label="Nama Pegawai"
            placeholder="Masukkan Nama Pegawai"
            required
        />

        <div>
            <label for="unit_kerja_id" class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
            <select id="unit_kerja_id" wire:model.defer="unit_kerja_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Unit Kerja --</option>
                @foreach ($unitKerjas as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                @endforeach
            </select>
            @error('unit_kerja_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <flux:button type="submit" variant="primary">
            Save
        </flux:button>
    </form>
</div>
