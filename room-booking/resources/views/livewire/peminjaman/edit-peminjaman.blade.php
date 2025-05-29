<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">
        Edit Peminjaman - {{ $peminjaman->id }}
    </h1>

    <!-- Form kirim ke Livewire method save -->
    <form wire:submit.prevent="save" class="space-y-4">

        <!-- Dropdown pilih Ruang -->
        <div>
            <label for="ruang_id" class="block text-sm font-medium text-gray-700 mb-1">Ruang</label>
            <select id="ruang_id" wire:model.defer="ruang_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Ruang --</option>
                @foreach ($ruangs as $ruang)
                    <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
                @endforeach
            </select>
            @error('ruang_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Dropdown pilih Pegawai -->
        <div>
            <label for="pegawai_id" class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
            <select id="pegawai_id" wire:model.defer="pegawai_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Pegawai --</option>
                @foreach ($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                @endforeach
            </select>
            @error('pegawai_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input tanggal -->
        <flux:input
            type="date"
            id="tanggal"
            wire:model.defer="tanggal"
            label="Tanggal"
            required
        />
        @error('tanggal')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Input jam mulai -->
        <flux:input
            type="time"
            id="jam_mulai"
            wire:model.defer="jam_mulai"
            label="Jam Mulai"
            required
        />
        @error('jam_mulai')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Input jam akhir -->
        <flux:input
            type="time"
            id="jam_akhir"
            wire:model.defer="jam_akhir"
            label="Jam Akhir"
            required
        />
        @error('jam_akhir')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Input keterangan -->
        <flux:input
            type="text"
            id="keterangan"
            wire:model.defer="keterangan"
            label="Keterangan"
            placeholder="Keterangan tambahan (opsional)"
        />
        @error('keterangan')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Tombol simpan -->
        <flux:button type="submit" variant="primary">
            Save
        </flux:button>
    </form>
</div>
