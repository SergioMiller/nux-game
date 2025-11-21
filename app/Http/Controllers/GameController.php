<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\Repositories\LinkRepositoryInterface;
use App\Interfaces\Repositories\RoundRepositoryInterface;
use App\Service\Game\GameService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class GameController extends Controller
{
    public function __construct(
        private readonly LinkRepositoryInterface $linkRepository,
        private readonly GameService $gameService,
        private readonly RoundRepositoryInterface $roundRepository,
    ) {
    }

    public function index(string $ref): View
    {
        $link = $this->linkRepository->get($ref);

        abort_if(Gate::denies('owner', $link), Response::HTTP_NOT_FOUND);

        return view('game.index', [
            'link' => $link,
        ]);
    }

    public function play(string $ref): RedirectResponse
    {
        $link = $this->linkRepository->get($ref);

        abort_if(Gate::denies('owner', $link), Response::HTTP_NOT_FOUND);

        $round = $this->gameService->play($link);

        return redirect()
            ->route('game.index', ['ref' => $ref])
            ->with('round', $round->toArray());
    }

    public function history(string $ref): View
    {
        $link = $this->linkRepository->get($ref);

        abort_if(Gate::denies('owner', $link), Response::HTTP_NOT_FOUND);

        $history = $this->roundRepository->getLastByLink($link);

        return view('game.history', [
            'link' => $link,
            'history' => $history,
        ]);
    }
}
