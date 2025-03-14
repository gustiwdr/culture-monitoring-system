@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Laporan Kegiatan Budaya</h1>
        <a href="{{ route('culture.reports.index') }}" class="text-blue-500">Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Form Edit Laporan Kegiatan</h2>

        <form action="{{ route('culture.reports.update', $report) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="activity_id" class="block text-gray-700">Pilih Kegiatan</label>
                <select name="activity_id" id="activity_id" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="{{ $report->activity_id }}" selected>
                        {{ $report->activity->name }}
                    </option>
                </select>                
                @error('activity_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="participants" class="block text-gray-700">Jumlah Peserta</label>
                <input type="number" name="participants" id="participants" value="{{ old('participants', $report->participants) }}" class="w-full p-2 border border-gray-300 rounded" required>
                @error('participants')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="summary" class="block text-gray-700">Ringkasan Kegiatan</label>
                <textarea name="summary" id="summary" class="w-full p-2 border border-gray-300 rounded" rows="4" required>{{ old('summary', $report->summary) }}</textarea>
                @error('summary')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700">Foto Kegiatan (Opsional)</label>
                <input type="file" name="photo" id="photo" class="w-full p-2 border border-gray-300 rounded" accept="image/*">
                @if ($report->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $report->photo) }}" alt="Foto Laporan" style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
                @error('photo')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-500">Perbarui Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
