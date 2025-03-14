@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Kegiatan Baru</h1>
        <a href="{{ route('culture.activities.index') }}" class="text-blue-500">Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Form Pengajuan Kegiatan</h2>

        <form action="{{ route('culture.activities.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Aktivitas</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="activity_date" class="block text-sm font-medium text-gray-700">Tanggal Aktivitas</label>
                <input type="date" name="activity_date" id="activity_date" class="w-full p-2 border border-gray-300 rounded" required>
                @error('activity_date')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="target_participants" class="block text-sm font-medium text-gray-700">Jumlah Peserta yang Diharapkan</label>
                <input type="number" name="target_participants" id="target_participants" class="w-full p-2 border border-gray-300 rounded" required>
                @error('target_participants')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 focus:outline-none">Ajukan Aktivitas</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('activity_date').setAttribute('min', today);
    });
</script>
@endsection
