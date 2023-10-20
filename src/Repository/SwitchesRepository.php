<?php

namespace App\Repository;

use App\Entity\Switches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Switches>
 *
 * @method Switches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Switches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Switches[]    findAll()
 * @method Switches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwitchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Switches::class);
    }

//    /**
//     * @return Switches[] Returns an array of Switches objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Switches
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
