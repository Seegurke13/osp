<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 20:27
 */

namespace App\Service;


use App\Entity\Participant;
use App\Entity\Protocol;
use App\Entity\Tag;
use App\Repository\ParticipantRepository;
use App\Repository\ProtocolRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ProtocolService
{
    /**
     * @var ProtocolRepository
     */
    private $protocolRepository;
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ParticipantRepository $participantRepository,
                                ProtocolRepository $protocolRepository,
                                Security $security,
                                EntityManagerInterface $entityManager)
    {
        $this->protocolRepository = $protocolRepository;
        $this->participantRepository = $participantRepository;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function getProtocolById(int $id)
    {
    }

    public function getProtocolsByParcipier(\App\Entity\Participant $parcipant)
    {
        $this->protocolRepository->findByParcipant($parcipant);
    }

    public function getProtocolsForTag(\App\Entity\Tag $tagE)
    {
        $user =  $this->security->getUser();
        $participant = $this->participantRepository->findByUserId($user->getUsername());

//        $return = [];
//        $protocols = $participant->getProtocols();
//
//        /** @var Protocol $protocol */
//        foreach ($protocols as $protocol) {
//            if ($protocol->hasTag($tagE) === true) {
//                $return[] = $protocol;
//            }
//        }
        $protocols = $this->protocolRepository->findProtocolsByTagAndParticipant($tagE, $participant);

        return $protocols;
    }
}