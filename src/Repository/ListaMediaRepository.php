<?php

namespace App\Repository;

use App\Entity\ListaMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListaMedia>
 */
class ListaMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListaMedia::class);
    }

    public function add(ListaMedia $lista, bool $flush = false): void
    {
        $this->getEntityManager()->persist($lista);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUsuario(int $idUsuario)
    {
       return $this->createQueryBuilder('listaMedia')
           ->andWhere('listaMedia.idUsuario = :idUsuario')
            ->setParameter('idUsuario', $idUsuario)
            ->orderBy('listaMedia.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return ListaMedia[] Returns an array of ListaMedia objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ListaMedia
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
