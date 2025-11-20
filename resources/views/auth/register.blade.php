@extends('layout.app')

@section('content')

    <form class="max-w-sm mx-auto" method="post" action="{{ route('auth.register') }}">
        @csrf

        <div class="mb-5">
            <label for="username"
                   class="block mb-2 text-sm font-medium text-gray-900 @error('username') text-red-700 @enderror">Username</label>
            <input type="text"
                   id="username"
                   name="username"
                   value="{{ old('username', $user->username ?? null) }}"
                   class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 text-red-900 placeholder-red-700 @enderror"/>
            @error('username')
            <p class="mt-1 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="phone_number"
                   class="block mb-2 text-sm font-medium text-gray-900 @error('phone_number') text-red-700 @enderror">Phone number</label>
            <input type="text"
                   id="phone_number"
                   name="phone_number"
                   value="{{ old('phone_number', $user->phone_number ?? null) }}"
                   class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 text-red-900 placeholder-red-700 @enderror"/>
            @error('phone_number')
            <p class="mt-1 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
            @enderror
        </div>


        <button type="submit"
                class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Register
        </button>
    </form>

@endsection
