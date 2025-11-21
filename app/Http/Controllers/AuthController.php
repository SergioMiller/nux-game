<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Service\Auth\AuthService;
use App\Service\Auth\Dto\LoginDto;
use App\Service\Link\LinkService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $accountService,
        private readonly LinkService $linkService,
    ) {
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(RegisterRequest $request): RedirectResponse
    {
        $user = $this->accountService->login(LoginDto::fromArray($request->validated()));

        Auth::login($user);
        $link = $this->linkService->generate($user);

        return redirect()->route('game.index', $link->ref)->with('success', 'You are welcome.');
    }
}
