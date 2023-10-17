<?php

namespace App\Repository;

use App\Entity\OrdersSweets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdersSweets>
 *
 * @method OrdersSweets|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdersSweets|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdersSweets[]    findAll()
 * @method OrdersSweets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersSweetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdersSweets::class);
    }

//    /**
//     * @return OrdersSweets[] Returns an array of OrdersSweets objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdersSweets
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
