@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Buat Laporan Kegiatan Budaya</h1>
        <a href="{{ route('culture.reports.index') }}" class="text-blue-500">Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Form Laporan Kegiatan</h2>

        <form action="{{ route('culture.reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="activity" class="block text-sm font-medium text-gray-700">Pilih Aktivitas</label>
                <select id="activity" name="activity_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">-- Pilih Aktivitas --</option>
                    @foreach($activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
                
            </div>
        
            <div class="mb-4">
                <label for="participants" class="block text-gray-700">Jumlah Peserta</label>
                <input type="number" name="participants" id="participants" class="w-full p-2 border border-gray-300 rounded" value="{{ old('participants') }}" required min="1">
                @error('participants')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-4">
                <label for="summary" class="block text-gray-700">Ringkasan Kegiatan</label>
                <textarea name="summary" id="summary" class="w-full p-2 border border-gray-300 rounded" rows="4" required>{{ old('summary') }}</textarea>
                @error('summary')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-4">
                <label for="photo" class="block text-gray-700">Foto Kegiatan</label>
                <input type="file" name="photo" id="photo" class="w-full p-2 border border-gray-300 rounded" accept="image/*">
                @error('photo')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-500">Simpan Laporan</button>
            </div>
        </form>
        
    </div>
</div>
@endsection
