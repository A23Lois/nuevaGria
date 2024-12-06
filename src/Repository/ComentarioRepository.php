<?php

namespace App\Repository;

use App\Entity\Comentario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comentario>
 */
class ComentarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comentario::class);
    }

    public function delete(int $id): void
    {
        $comentario = $this->getById($id);
        $entityManager = $this->getEntityManager();

        if ($comentario) {
            $entityManager->remove($comentario);
            $entityManager->flush();
        }
    }

    public function add(Comentario $comentario, bool $flush = false): void
    {
        $this->getEntityManager()->persist($comentario);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(Comentario $comentario, bool $flush = false): void
    {
        $this->getEntityManager()->persist($comentario);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    
    public function findByUsuario(int $idUsuario)
    {
       return $this->createQueryBuilder('comentario')
           ->andWhere('comentario.idUsuario = :idUsuario')
            ->setParameter('idUsuario', $idUsuario)
            ->orderBy('comentario.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByMedia(int $idMedia)
    {
       return $this->createQueryBuilder('comentario')
           ->andWhere('comentario.idMedia = :idMedia')
            ->setParameter('idMedia', $idMedia)
            ->orderBy('comentario.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getByUsuarioMedia(int $idUsuario, int $idMedia)
    {
       return $this->createQueryBuilder('comentario')
           ->andWhere('comentario.idUsuario = :idUsuario and comentario.idMedia = :idMedia')
            ->setParameter('idUsuario', $idUsuario)
            ->setParameter('idMedia', $idMedia)
            ->orderBy('comentario.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    //    /**
    //     * @return Comentario[] Returns an array of Comentario objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Comentario
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
