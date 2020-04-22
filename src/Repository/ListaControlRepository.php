<?php

namespace App\Repository;

use App\Entity\ListaControl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListaControl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListaControl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListaControl[]    findAll()
 * @method ListaControl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListaControlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListaControl::class);
    }

    // /**
    //  * @return ListaControl[] Returns an array of ListaControl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListaControl
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
