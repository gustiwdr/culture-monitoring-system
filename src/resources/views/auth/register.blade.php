@extends('layouts.auth')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-500 to-teal-600 py-10">
        <div class="bg-white p-8 rounded-xl shadow-lg w-96">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Register</h2>

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

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input type="text" name="name" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Role</label>
                    <select name="role" class="w-full p-3 border border-gray-300 rounded-lg" required>
                        <option value="culture_agent">Culture Agent</option>
                        <option value="division_head">Division Head</option>
                        <option value="admin_hc">Admin HC</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Division</label>
                    <select name="division_id" class="w-full p-3 border border-gray-300 rounded-lg">
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>                
                <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition">Register</button>
            </form>
            

            <div class="mt-4 text-center">
                <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-green-500">Login</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.add("text-blue-500");
            } else {
                input.type = "password";
                icon.classList.remove("text-blue-500");
            }
        }
    </script>
@endsection
