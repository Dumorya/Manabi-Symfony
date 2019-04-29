<?php

namespace App\Repository;

use App\Entity\WordsList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WordsList|null find($id, $lockMode = null, $lockVersion = null)
 * @method WordsList|null findOneBy(array $criteria, array $orderBy = null)
 * @method WordsList[]    findAll()
 * @method WordsList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WordsListRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WordsList::class);
    }

    // /**
    //  * @return WordsList[] Returns an array of WordsList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WordsList
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
