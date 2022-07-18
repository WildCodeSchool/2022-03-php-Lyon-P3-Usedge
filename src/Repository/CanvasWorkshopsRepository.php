<?php

namespace App\Repository;

use App\Entity\CanvasWorkshops;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CanvasWorkshops>
 *
 * @method CanvasWorkshops|null find($id, $lockMode = null, $lockVersion = null)
 * @method CanvasWorkshops|null findOneBy(array $criteria, array $orderBy = null)
 * @method CanvasWorkshops[]    findAll()
 * @method CanvasWorkshops[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CanvasWorkshopsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CanvasWorkshops::class);
    }

    public function add(CanvasWorkshops $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CanvasWorkshops $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CanvasWorkshops[] Returns an array of CanvasWorkshops objects
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

//    public function findOneBySomeField($value): ?CanvasWorkshops
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
