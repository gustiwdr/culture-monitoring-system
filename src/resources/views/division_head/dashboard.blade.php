@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 pl-64">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Dashboard Division Head</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Menunggu Persetujuan Division Head</h2>

        @if($activitiesToApprove->isEmpty())
            <p>Tidak ada kegiatan yang perlu dipantau atau diupdate statusnya.</p>
        @else
            <ul>
                @foreach($activitiesToApprove as $activity)
                    <li class="bg-white p-4 rounded-lg shadow mb-4">
                        <h3 class="font-semibold text-lg">{{ $activity->name }}</h3>
                        <p>{{ $activity->description }}</p>
                        <p><strong>Tanggal:</strong> {{ $activity->activity_date }}</p>

                        <p><strong>Status Aktivitas:</strong> {{ ucfirst($activity->activity_status) }}</p>
                        <p><strong>Status Persetujuan:</strong> {{ ucfirst($activity->approval_status) }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
