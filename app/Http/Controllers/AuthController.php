<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Service\Account\AuthService;
use App\Service\Account\Dto\LoginDto;
use Illuminate\Contracts\View\View;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $accountService,
    ) {
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): View
    {
        $user = $this->accountService->login(LoginDto::fromArray($request->validated()));
        dd($user);

        return view('game.index', [
            'user' => $request->user(),
        ]);
    }
}
