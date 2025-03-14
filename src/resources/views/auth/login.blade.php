@extends('layouts.auth')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600">
        <div class="bg-white p-8 rounded-xl shadow-lg w-96">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Login</h2>

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-500 text-white p-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">Login</button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
            </div>
        </div>
    </div>
@endsection
