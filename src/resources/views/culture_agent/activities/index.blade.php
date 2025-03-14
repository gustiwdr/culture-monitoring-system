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
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Aktivitas yang Diajukan</h1>
        @if (auth()->user()->isCultureAgent())
            <a href="{{ route('culture.activities.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded">Tambah Aktivitas</a>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Aktivitas</th>
                        <th class="px-4 py-2 border">Status Persetujuan</th>
                        <th class="px-4 py-2 border">Status Aktivitas</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activitiesToMonitor as $activity)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $activity->name }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($activity->approval_status) }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($activity->activity_status) }}</td>
                            <td class="px-4 py-2 border">
                                @if (auth()->user()->isCultureAgent() && $activity->created_by == auth()->id())
                                    <a href="{{ route('culture.activities.edit', $activity->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                    <form action="{{ route('culture.activities.destroy', $activity->id) }}" method="POST" class="inline ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                @elseif($activity->activity_status == 'scheduled')
                                    <a href="{{ route('culture.activities.update-status', $activity->id) }}" class="text-blue-500">Update Status</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection
