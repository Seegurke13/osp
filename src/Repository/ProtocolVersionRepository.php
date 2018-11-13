<?php

namespace App\Repository;

use App\Entity\ProtocolVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProtocolVersion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProtocolVersion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProtocolVersion[]    findAll()
 * @method ProtocolVersion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtocolVersionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProtocolVersion::class);
    }

    // /**
    //  * @return ProtocolVersion[] Returns an array of ProtocolVersion objects
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
    public function findOneBySomeField($value): ?ProtocolVersion
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
