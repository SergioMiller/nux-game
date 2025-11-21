@extends('layout.app')

@section('content')
    <p class="mb-5">
        <a href="{{ route('game.index', $link->ref) }}"
           class="cursor-pointer text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Back
        </a>
    </p>

    @forelse ($history as $round)
        <div class="border-b border-gray-400 mb-5 pt-4 pb-4">
            @include('game._round', ['round' => $round])
        </div>
    @empty
        <p>History is empty.</p>
    @endforelse
@endsection
