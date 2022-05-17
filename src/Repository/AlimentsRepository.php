<?php

namespace App\Repository;

use App\Entity\Aliments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Aliments>
 *
 * @method Aliments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliments[]    findAll()
 * @method Aliments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliments::class);
    }

    public function add(Aliments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Aliments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Aliments[] Returns an array of Aliments objects
    */
   public function findBySearch($searchValue): array
   {
       return $this->createQueryBuilder('a')
           ->andWhere('a.name like :val')
           ->setParameter('val', '%'.$searchValue.'%')
           ->orderBy('a.name', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   /**
    * @return Aliments[] Returns an array of Aliments objects
    */
    public function findByFilter($criteriaFilters): array
    {
        // return $this->createQueryBuilder('a')
        //     ->andWhere('a.name like :val')
        //     ->setParameter('val', '%'.$searchValue.'%')
        //     ->orderBy('a.name', 'ASC')
        //     ->setMaxResults(10)
        //     ->getQuery()
        //     ->getResult()
        // ;
        $result = $this->createQueryBuilder('a')
        ->orderBy('a.id', 'ASC');

        if(array_key_exists('categoryAliments', $criteriaFilters)){
            dump($criteriaFilters['categoryAliments']);

            $result->andWhere('a.categoryAliments = :val');
            $result->setParameter('val', $criteriaFilters['categoryAliments']);
        }

        // if(array_key_exists('seasonsToConsume', $criteriaFilters)){
        //     dump($criteriaFilters['seasonsToConsume']);

            
        //     $result->andWhere(':season IN (a.seasonsToConsume)')
        //     ->setParameter('season', $criteriaFilters['seasonsToConsume']);
        // }
        
        $zz = $result->getQuery()     
                ->getResult();
                dump($result);
                dump($zz);
        return  $zz;
    }


//    /**
//     * @return Aliments[] Returns an array of Aliments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Aliments
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
