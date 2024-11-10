<?php

namespace App\Repository;

use App\Entity\Genero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genero>
 */
class GeneroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genero::class);
    }

    public function add(Genero $genero, bool $flush = false): void
    {
        $this->getEntityManager()->persist($genero);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById($id): Genero
    {
       return $this->createQueryBuilder('genero')
           ->andWhere('genero.id = :id')
            ->setParameter('id', $id)
            ->orderBy('genero.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getFirstResult()[0]
        ;
    }
    //    /**
    //     * @return Genero[] Returns an array of Genero objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Genero
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
