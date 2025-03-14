@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            <strong class="font-bold">Success:</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif


    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif


    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Laporan Kegiatan Budaya</h1>
        @if (auth()->user()->isCultureAgent())
            <a href="{{ route('culture.reports.create', ['activity' => 1]) }}" class="bg-blue-500 text-white px-6 py-2 rounded">Buat Laporan</a>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kegiatan</th>
                    <th class="px-4 py-2 border">Activity ID</th>
                    <th class="px-4 py-2 border">Peserta</th>
                    <th class="px-4 py-2 border">Ringkasan</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $report->activity->name }}</td>
                        <td class="px-4 py-2 border">{{ $report->activity_id }}</td>
                        <td class="px-4 py-2 border">{{ $report->participants }}</td>
                        <td class="px-4 py-2 border">{{ Str::limit($report->summary, 50) }}</td>
                        <td class="px-4 py-2 border">
                            @if (auth()->user()->isCultureAgent() && $report->created_by == auth()->id())
                                <a href="{{ route('culture.reports.edit', $report) }}" class="text-yellow-500 hover:underline">Edit</a>
                                <form action="{{ route('culture.reports.destroy', $report) }}" method="POST" class="inline ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            @endif
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
