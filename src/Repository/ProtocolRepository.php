<?php

namespace App\Repository;

use App\Entity\Participant;
use App\Entity\Protocol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Protocol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Protocol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Protocol[]    findAll()
 * @method Protocol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtocolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Protocol::class);
    }

    public function save(Protocol $protocol)
    {
        $this->getEntityManager()->persist($protocol);
        $this->getEntityManager()->flush();
    }

    public function findByParcipant(Participant $participant)
    {
        $qb = $this->createQueryBuilder("p")
            ->where(':parcipant MEMBER OF p.participants')
            ->setParameters(array('parcipant' => $participant))
        ;
        return $qb->getQuery()->execute();
    }

    public function findProtocolsByTagAndParticipant(\App\Entity\Tag $tagE, Participant $participant)
    {
        $qb = $this->createQueryBuilder('protocol')
            ->innerJoin('protocol.tags', 'tag', 'WITH', 'tag.name = :name')
            ->innerJoin('protocol.participants', 'participant', 'WITH', 'participant = :participant')
            ->setParameter('name', $tagE->getName())
            ->setParameter('participant', $participant);

        return $qb->getQuery()->execute();
    }

    // /**
    //  * @return Protocol[] Returns an array of Protocol objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Protocol
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
