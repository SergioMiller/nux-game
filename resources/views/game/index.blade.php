@extends('layout.app')

@section('content')

    <div class="text-right">
        <p class="mb-5">Your current session is:</p>
        <p class="mb-5"><strong>{{ $link->ref }}</strong></p>
        <p class="mb-5"><strong>Expires at:</strong> {{ $link->expires_at->toDateTimeString() }}</p>
        <form class="mb-5" action="{{ route('link.regenerate', $link->ref) }}" method="POST">
            @csrf

            <p>
                <button type="submit"
                        class="cursor-pointer text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Regenerate
                </button>
            </p>
        </form>
        <form class="mb-5" action="{{ route('link.deactivate', $link->ref) }}" method="POST">
            @csrf

            <p>
                <button type="submit"
                        class="cursor-pointer text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Deactivate
                </button>
            </p>
        </form>
    </div>

    <div class="text-center">
        <form class="mb-5" action="{{ route('game.play', $link->ref) }}" method="POST">
            @csrf

            <p>
                <button type="submit"
                        class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Imfeelinglucky
                </button>
            </p>
        </form>
    </div>

    @if ($round = session()->get('round'))
        @include('game._round', ['round' => $round])
    @endif

    <div class="text-center">
        <form class="mb-5" action="{{ route('game.play', $link->ref) }}" method="POST">
            @csrf

            <p>
                <a href="{{ route('game.history', $link->ref) }}"
                        class="cursor-pointer text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    History
                </a>
            </p>
        </form>
    </div>

@endsection
