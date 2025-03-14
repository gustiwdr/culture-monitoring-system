@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <h1 class="text-2xl font-semibold text-gray-800">Laporan Aktivitas</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ $report->activity->title }}</h2>
        <p><strong>Pelapor:</strong> {{ $report->user->name }}</p>
        <p><strong>Tanggal Dibuat:</strong> {{ $report->created_at->format('d M Y') }}</p>
        <p class="mb-4"><strong>Deskripsi:</strong> {{ $report->summary }}</p> 

        @if($report->attachment)
            <div class="mt-4">
                <strong>Attachment:</strong>
                <a href="{{ asset('storage/' . $report->attachment) }}" class="text-blue-500 hover:text-blue-700" target="_blank">Lihat Lampiran</a>
            </div>
        @endif

        <a href="{{ route('admin.reports.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-6 inline-block">Kembali ke Daftar Laporan</a> 
    </div>
</div>
@endsection
