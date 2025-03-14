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
        <h1 class="text-2xl font-semibold text-gray-800">Aktivitas yang Menunggu Persetujuan</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        @if ($activitiesToApprove->isEmpty())
            <p class="text-gray-500">Tidak ada aktivitas yang perlu disetujui.</p>
        @else
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">No</th>
                        <th class="px-4 py-2 text-left border">Nama Aktivitas</th>
                        <th class="px-4 py-2 text-left border">Status Persetujuan</th>
                        <th class="px-4 py-2 text-left border">Status Aktivitas</th>
                        <th class="px-4 py-2 text-left border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activitiesToApprove as $activity)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $activity->name }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($activity->approval_status) }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($activity->activity_status) }}</td>
                            <td class="px-4 py-2 border">
                                @if ($activity->approval_status == 'pending')
                                    <form action="{{ route('division.activities.approve-head', $activity->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400">Setujui</button>
                                    </form>
                            
                                    <form action="{{ route('division.activities.reject-head', $activity->id) }}" method="POST" class="inline ml-4">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-400">Tolak</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Tindakan tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
