@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Reports Management</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Laporan</h2>

        @if($reports->isEmpty())
            <p>Tidak ada laporan yang tersedia.</p>
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
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="text-green-500 hover:text-green-700">View</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
