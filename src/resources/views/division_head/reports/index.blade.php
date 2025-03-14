@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Laporan Aktivitas</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Laporan</h2>

        @if($reports->isEmpty())
            <p class="text-gray-500">Tidak ada laporan untuk ditampilkan.</p>
        @else
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b text-left text-gray-700">#</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Activity</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Reporter</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Created At</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-b">{{ $report->activity->title }}</td>
                            <td class="px-4 py-2 border-b">{{ $report->user->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $report->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('division.reports.show', $report->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
