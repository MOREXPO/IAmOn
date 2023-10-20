<?php

namespace App\Message;

class StartCountdown
{
    private $countdownId;
    private $delay;

    public function __construct(string $countdownId, int $delay)
    {
        $this->countdownId = $countdownId;
        $this->delay = $delay;
    }

    public function getCountdownId(): string
    {
        return $this->countdownId;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}
