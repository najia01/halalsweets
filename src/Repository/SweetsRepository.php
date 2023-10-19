<?php

namespace App\Repository;

use App\Entity\Sweets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sweets>
 *
 * @method Sweets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sweets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sweets[]    findAll()
 * @method Sweets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SweetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sweets::class);
    }

    // trouver les bonbons par categorie
    public function findSweetsByCategory($category): array
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.categories', 'c')
            ->where('c.id = :category_id')
            ->setParameter('category_id', $category->getId())
            ->getQuery()
            ->getResult();
    }
    public function findSweetById($id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // pour la recherche 


    public function findSweetsByName(string $name): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Sweets[] Returns an array of Sweets objects
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

    //    public function findOneBySomeField($value): ?Sweets
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
