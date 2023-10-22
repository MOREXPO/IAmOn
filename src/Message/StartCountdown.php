<?php

namespace App\Message;

class StartCountdown
{
    private $countdownId;

    public function __construct(string $countdownId, int $delay)
    {
        $this->countdownId = $countdownId;
    }

    public function getCountdownId(): string
    {
        return $this->countdownId;
    }
}
