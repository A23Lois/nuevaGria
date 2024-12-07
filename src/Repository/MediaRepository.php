<?php

namespace App\Repository;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Media>
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    public function delete(int $id): void
    {
        $media = $this->getById($id);
        $entityManager = $this->getEntityManager();

        if ($media) {
            $entityManager->remove($media);
            $entityManager->flush();
        }
    }

    public function add(Media $media, bool $flush = false): void
    {
        if($media->getIdPrecuela() == 0){
            $media->setIdPrecuela(null);
        }
        if($media->getIdSecuela() == 0){
            $media->setIdSecuela(null);
        }
        
        $this->getEntityManager()->persist($media);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById($id)
    {
       return $this->createQueryBuilder('media')
           ->andWhere('media.id = :id')
            ->setParameter('id', $id)
            ->orderBy('media.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findUltimas12()
    {
       return $this->createQueryBuilder('media')
            ->orderBy('media.id', 'DESC')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();
    }

    public function findByTitulo(string $titulo)
    {
       return $this->createQueryBuilder('media')
            ->andWhere('media.titulo like :titulo or media.tituloOriginal like :titulo')
            ->setParameter('titulo', '%'.$titulo.'%')
            ->orderBy('media.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Media[] Returns an array of Media objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Media
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
