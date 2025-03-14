@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Kegiatan</h1>
        <a href="{{ route('culture.activities.index') }}" class="text-blue-500">Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Form Edit Kegiatan</h2>

        <form action="{{ route('culture.activities.update', $activity->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama Kegiatan</label>
                <input type="text" name="name" id="name" value="{{ old('name', $activity->name) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded" rows="4" required>{{ old('description', $activity->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="activity_date" class="block text-gray-700">Tanggal Kegiatan</label>
                <input type="date" name="activity_date" id="activity_date" value="{{ old('activity_date', $activity->activity_date) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="target_participants" class="block text-gray-700">Target Peserta</label>
                <input type="number" name="target_participants" id="target_participants" value="{{ old('target_participants', $activity->target_participants) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="activity_status" class="block text-gray-700">Status Aktivitas</label>
                <select name="activity_status" id="activity_status" class="w-full p-2 border border-gray-300 rounded">
                    <option value="scheduled" {{ $activity->activity_status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="done" {{ $activity->activity_status == 'done' ? 'selected' : '' }}>Done</option>
                    <option value="canceled" {{ $activity->activity_status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="approval_status" class="block text-gray-700">Status Persetujuan</label>
                <p class="w-full p-2 border border-gray-300 rounded">{{ ucfirst($activity->approval_status) }}</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-500">Update Kegiatan</button>
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
