<?php

namespace App\Repository;

use App\Entity\Controlado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Controlado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Controlado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Controlado[]    findAll()
 * @method Controlado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControladoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Controlado::class);
    }

    // /**
    //  * @return Controlado[] Returns an array of Controlado objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Controlado
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
