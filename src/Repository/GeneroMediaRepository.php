<?php

namespace App\Repository;

use App\Entity\GeneroMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeneroMedia>
 */
class GeneroMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneroMedia::class);
    }

    public function delete(int $id): void
    {
        $generoMedia = $this->getById($id);
        $entityManager = $this->getEntityManager();

        if ($generoMedia) {
            $entityManager->remove($generoMedia);
            $entityManager->flush();
        }
    }

    public function add(GeneroMedia $generoMedia, bool $flush = false): void
    {
        $this->getEntityManager()->persist($generoMedia);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById(int $id)
    {
       return $this->createQueryBuilder('generoMedia')
            ->andWhere('generoMedia.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByIdMedia(int $idMedia)
    {
       return $this->createQueryBuilder('generoMedia')
            ->andWhere('generoMedia.idMedia = :idMedia')
            ->orderBy('generoMedia.idGenero', 'DESC')
            ->setParameter('idMedia', $idMedia)
            ->getQuery()
            ->getResult();
    }

    public function getByMediaGenero(int $idMedia, int $idGenero)
    {
       return $this->createQueryBuilder('generoMedia')
            ->andWhere('generoMedia.idMedia = :idMedia and generoMedia.idGenero = :idGenero')
            ->setParameter('idMedia', $idMedia)
            ->setParameter('idGenero', $idGenero)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return GeneroMedia[] Returns an array of GeneroMedia objects
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

    //    public function findOneBySomeField($value): ?GeneroMedia
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
