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

    public function delete(int $id): void
    {
        $listaMedia = $this->getById($id);
        $entityManager = $this->getEntityManager();

        if ($listaMedia) {
            $entityManager->remove($listaMedia);
            $entityManager->flush();
        }
    }

    public function add(ListaMedia $lista, bool $flush = false): void
    {
        $this->getEntityManager()->persist($lista);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById($id)
    {
       return $this->createQueryBuilder('listaMedia')
           ->andWhere('listaMedia.id = :id')
            ->setParameter('id', $id)
            ->orderBy('listaMedia.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
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

    public function getByUsuarioMedia(int $idUsuario, int $idMedia)
    {
       return $this->createQueryBuilder('listaMedia')
           ->andWhere('listaMedia.idUsuario = :idUsuario and listaMedia.idMedia = :idMedia')
            ->setParameter('idUsuario', $idUsuario)
            ->setParameter('idMedia', $idMedia)
            ->orderBy('listaMedia.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
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
