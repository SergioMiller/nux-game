<?php
declare(strict_types=1);

namespace App\Service\Account\Dto;

final readonly class LoginDto
{
    public function __construct(
        private string $username,
        private string $phoneNumber,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            username: $data['username'],
            phoneNumber: $data['phone_number'],
        );
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
