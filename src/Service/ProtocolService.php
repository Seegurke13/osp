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
use App\Entity\ProtocolContent;
use App\Entity\Tag;
use App\Repository\ParticipantRepository;
use App\Repository\ProtocolRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
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
    /**
     * @var ParticipantService
     */
    private $participantService;

    public function __construct(ParticipantRepository $participantRepository,
                                ProtocolRepository $protocolRepository,
                                Security $security,
                                EntityManagerInterface $entityManager,
                                ParticipantService $participantService)
    {
        $this->protocolRepository = $protocolRepository;
        $this->participantRepository = $participantRepository;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->participantService = $participantService;
    }

    public function getProtocolsByParcipier(\App\Entity\Participant $parcipant)
    {
        $this->protocolRepository->findByParcipant($parcipant);
    }

    public function getProtocolsForTag(\App\Entity\Tag $tagE)
    {
        $participant = $this->participantService->getActualParticipant();

        $protocols = $this->protocolRepository->findProtocolsByTagAndParticipant($tagE, $participant);

        return $protocols;
    }

    public function getProtocols()
    {
        $participant = $this->participantService->getActualParticipant();

        $qb = $this->protocolRepository->createQueryBuilder('p');
        $query = $qb->Orwhere(':participant MEMBER OF p.participants')
            ->orWhere('p.creator = :participant')
            ->setParameters(array('participant' => $participant))
            ->orderBy('p.createAt')
            ->getQuery();

        $result = $query->getResult();

         return $result;
    }

    public function getProtocolsBySearchTerm(string $searchterm)
    {
        $participant = $this->participantService->getActualParticipant();

        $qb = $this->protocolRepository->createQueryBuilder('p');

        $criteria = Criteria::create();
        $criteria->orWhere(Criteria::expr()->contains('pc.name', ':searchterm'));
        $criteria->orWhere(Criteria::expr()->contains('pc.result', ':searchterm'));

        $query = $qb->Orwhere(':participant MEMBER OF p.participants')
            ->orWhere('p.creator = :participant')
            ->join(ProtocolContent::class, 'pc')
            ->addCriteria($criteria)
            ->setParameters([
                'participant' => $participant,
                'pc_result' => '%'.$searchterm.'%',
                'pc_name' => '%'.$searchterm.'%',
            ])
            ->orderBy('p.createAt')
            ->getQuery();

        $result = $query->getResult();

        return $result;
    }
}