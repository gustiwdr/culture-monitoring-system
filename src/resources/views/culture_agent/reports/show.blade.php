@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Laporan Kegiatan Budaya</h1>
        <a href="{{ route('culture.reports.index') }}" class="text-blue-500">Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ $report->activity->name }}</h2>

        <p><strong>Activity ID:</strong> {{ $report->activity_id }}</p> <!-- Display activity_id -->
        <p><strong>Jumlah Peserta:</strong> {{ $report->participants }}</p>
        <p><strong>Ringkasan:</strong> {{ $report->summary }}</p>

        @if ($report->photo)
            <p><strong>Foto Kegiatan:</strong></p>
            <img src="{{ asset('storage/' . $report->photo) }}" alt="Foto Laporan" class="max-w-full h-auto mt-2">
        @endif

        <div class="flex gap-4 mt-4">
            @if (auth()->user()->isCultureAgent() && $report->created_by == auth()->id())
                <a href="{{ route('culture.reports.edit', $report) }}" class="text-yellow-500 hover:text-yellow-400">Edit Laporan</a>
            @endif
        </div>
    </div>
</div>
@endsection
