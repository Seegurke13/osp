<?php

namespace App\Repository;

use App\Entity\ProtocolContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProtocolContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProtocolContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProtocolContent[]    findAll()
 * @method ProtocolContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtocolContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProtocolContent::class);
    }

    // /**
    //  * @return ProtocolContent[] Returns an array of ProtocolContent objects
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
    public function findOneBySomeField($value): ?ProtocolContent
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
