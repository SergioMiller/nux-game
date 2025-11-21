<?php
declare(strict_types=1);

namespace App\Service\Link;

use App\Interfaces\Repositories\LinkRepositoryInterface;
use App\Models\Link;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

readonly class LinkService
{
    public function __construct(
        private LinkRepositoryInterface $linkRepository
    ) {
    }

    public function generate(User $user): Link
    {
        $link = new Link();
        $link->user_id = $user->getKey();
        $link->ref = $this->generateRef();
        $link->expires_at = $this->generateExpiresAt()->toDateTimeString();

        return $this->linkRepository->save($link);
    }

    public function regenerate(Link $link): Link
    {
        $link->ref = $this->generateRef();
        $link->expires_at = $this->generateExpiresAt()->toDateTimeString();

        return $this->linkRepository->save($link);
    }

    private function generateRef(): string
    {
        do {
            $ref = Str::random(config('game.link_ref_length'));
        } while ($this->linkRepository->refExists($ref));

        return $ref;
    }

    public function deactivate(Link $link): Link
    {
        $link->deactivated_at = Carbon::now()->toDateTimeString();

        return $this->linkRepository->save($link);
    }

    private function generateExpiresAt(): Carbon
    {
        return Carbon::now()->addSeconds(config('game.link_lifetime'));
    }
}
