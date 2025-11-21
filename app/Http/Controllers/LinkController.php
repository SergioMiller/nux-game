<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\Repositories\LinkRepositoryInterface;
use App\Service\Link\LinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class LinkController extends Controller
{
    public function __construct(
        private readonly LinkRepositoryInterface $linkRepository,
        private readonly LinkService $linkService,
    ) {
    }

    public function regenerate(string $ref): RedirectResponse
    {
        $link = $this->linkRepository->get($ref);

        abort_if(Gate::denies('owner', $link), Response::HTTP_NOT_FOUND);

        $link = $this->linkService->regenerate($link);

        return redirect()->route('game.index', $link->ref)->with('success', 'Link regenerated successfully.');
    }

    public function deactivate(string $ref): RedirectResponse
    {
        $link = $this->linkRepository->get($ref);

        abort_if(Gate::denies('owner', $link), Response::HTTP_NOT_FOUND);

        $link = $this->linkService->deactivate($link);

        return redirect()->route('auth.login')->with(
            'success',
            sprintf('Link %s deactivated.', $link->ref)
        );
    }
}
