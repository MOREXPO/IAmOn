<?php

namespace App\MessageHandler;

use App\Message\StartCountdown;
use App\Repository\SwitchesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class StartCountdownHandler
{
    public function __construct(
   
        private SwitchesRepository $switchesRepository,
        private EntityManagerInterface $entityManager

    ) {}

    public function __invoke(StartCountdown $message)
    {
        $countdownId = $message->getCountdownId();
        $delay = $message->getDelay();

        if ($delay === null || $delay < 0) {
            // El mensaje tiene un tiempo negativo, lo que indica la anulación de la cuenta atrás
            return;
        }
        $switch=$this->switchesRepository->find($countdownId);
        $switch->setState(false);
        $switch->setClickDate(new DateTime());

        $this->entityManager->persist($switch);

        $this->entityManager->flush();
    }
}
