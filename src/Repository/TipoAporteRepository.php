<?php

namespace App\Repository;

use App\Entity\TipoAporte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoAporte>
 */
class TipoAporteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoAporte::class);
    }

    public function add(TipoAporte $tipoAporte, bool $flush = false): void
    {
        $this->getEntityManager()->persist($tipoAporte);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById($id): TipoAporte
    {
       return $this->createQueryBuilder('tipoAporte')
           ->andWhere('tipoAporte.id = :id')
            ->setParameter('id', $id)
            ->orderBy('tipoAporte.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()[0]
        ;
    }
    //    /**
    //     * @return TipoAporte[] Returns an array of TipoAporte objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TipoAporte
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
