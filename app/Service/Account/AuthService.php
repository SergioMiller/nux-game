<?php
declare(strict_types=1);

namespace App\Service\Account;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Service\Account\Dto\LoginDto;

final readonly class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function login(LoginDto $data): User
    {
        $user = $this->userRepository->get($data->getUsername(), $data->getPhoneNumber());

        if (null !== $user) {
            return $user;
        }

        $user = new User();
        $user->username = $data->getUsername();
        $user->phone_number = $data->getPhoneNumber();

        return $this->userRepository->save($user);
    }
}
