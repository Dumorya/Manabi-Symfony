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

    /**
     * @return WordsList[]
     */
    public function countUserLists($userId)
    {
        return $this->createQueryBuilder('w')
                    ->select('count(w.id)')
                    ->andWhere('w.userId = :user_id')
                    ->setParameter('user_id', $userId)
                    ->getQuery()
                    ->getSingleScalarResult()
            ;
    }

    public function getUserLists($userId)
    {
        return $this->createQueryBuilder('u')
                    ->andWhere('u.userId = :user_id')
                    ->setParameter('user_id', $userId)
                    ->getQuery()
                    ->getResult()
            ;

//        $entityManager = $this->getEntityManager();
//
//        $query = $entityManager->createQuery(
//            'SELECT w
//        FROM App\Entity\WordsList w
//        WHERE w.userId = :user_id'
//        )->setParameter('user_id', $userId);
//
//        // returns an array of Product objects
//        return $query->execute();

//        $conn = $this->getEntityManager()->getConnection();
//
//        $sql = '
//        SELECT * FROM words_list w
//        WHERE w.user_id_id = :user_id
//        ';
//        $stmt = $conn->prepare($sql);
//        $stmt->execute(['user_id' => $userId]);
//
//        // returns an array of arrays (i.e. a raw data set)
//        return $stmt->fetchAll();
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
