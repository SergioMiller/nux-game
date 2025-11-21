@if(true === $round['was_win'])
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        <strong>You win!</strong>
    </div>
@else
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <strong>You lose!</strong>
    </div>
@endif


<p class="mb-5"><strong>Random number: </strong>{{ $round['number'] }}</p>
<p class="mb-5"><strong>Win number: </strong>{{ $round['win_number'] }}</p>
