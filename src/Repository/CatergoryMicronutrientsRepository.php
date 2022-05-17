<?php

namespace App\Repository;

use App\Entity\CatergoryMicronutrients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatergoryMicronutrients>
 *
 * @method CatergoryMicronutrients|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatergoryMicronutrients|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatergoryMicronutrients[]    findAll()
 * @method CatergoryMicronutrients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatergoryMicronutrientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatergoryMicronutrients::class);
    }

    public function add(CatergoryMicronutrients $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CatergoryMicronutrients $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CatergoryMicronutrients[] Returns an array of CatergoryMicronutrients objects
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

//    public function findOneBySomeField($value): ?CatergoryMicronutrients
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
