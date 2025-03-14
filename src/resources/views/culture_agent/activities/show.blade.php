@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Kegiatan</h1>
        <a href="{{ route('activities.index') }}" class="text-blue-500">Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ $activity->name }}</h2>

        <p><strong>Deskripsi:</strong> {{ $activity->description }}</p>
        <p><strong>Tanggal:</strong> {{ $activity->activity_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($activity->status) }}</p>
        <p><strong>Target Peserta:</strong> {{ $activity->target_participants }}</p>

        <div class="flex gap-4 mt-4">
            @if($activity->status == 'pending')
                <a href="{{ route('activities.edit', $activity->id) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Hapus</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
