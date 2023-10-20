<?php

namespace App\Repository;

use App\Entity\UserSwitch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSwitch>
 *
 * @method UserSwitch|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSwitch|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSwitch[]    findAll()
 * @method UserSwitch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSwitchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSwitch::class);
    }

//    /**
//     * @return UserSwitch[] Returns an array of UserSwitch objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserSwitch
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
