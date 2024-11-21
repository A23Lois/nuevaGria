<?php

namespace App\Repository;

use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Persona>
 */
class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    public function add(Persona $persona, bool $flush = false): void
    {
        $this->getEntityManager()->persist($persona);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById($id): Persona
    {
       return $this->createQueryBuilder('persona')
           ->andWhere('persona.id = :id')
            ->setParameter('id', $id)
            ->orderBy('persona.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getFirstResult()[0]
        ;
    }
    //    /**
    //     * @return Persona[] Returns an array of Persona objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Persona
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
