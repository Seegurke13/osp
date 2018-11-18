<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 16.11.2018
 * Time: 14:34
 */

namespace App\Service;


use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ParticipantService
{
    /**
     * @var Security
     */
    private $security;
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    public function __construct(Security $security, ParticipantRepository $participantRepository)
    {
        $this->security = $security;
        $this->participantRepository = $participantRepository;
    }

    public function getActualParticipant(): Participant
    {
        $user =  $this->security->getUser();
        $participant = $this->participantRepository->findByUserId($user->getUsername());
        if ($participant === null) {
            $participant = new Participant();
            $participant->setName($user->getUsername());
            $this->participantRepository->save($participant);
        }

        return $participant;
    }

    public function findParticipant(Participant $participant)
    {
        $participant = $this->participantRepository->findByUserId($participant->getName());
        if($participant !== null) {
            return $participant;
        }
    }
}
