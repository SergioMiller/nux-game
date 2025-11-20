<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Service\Account\AuthService;
use App\Service\Account\Dto\LoginDto;
use Illuminate\Contracts\View\View;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $accountService,
    ) {
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): View
    {
        $user = $this->accountService->login(LoginDto::fromArray($request->validated()));
        dd($user);

        return view('game.index', [
            'user' => $request->user(),
        ]);
    }
}
