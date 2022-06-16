<?php

namespace App\Repository;

use App\Entity\ComponentEvaluationScale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ComponentEvaluationScale>
 *
 * @method ComponentEvaluationScale|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComponentEvaluationScale|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComponentEvaluationScale[]    findAll()
 * @method ComponentEvaluationScale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComponentEvaluationScaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComponentEvaluationScale::class);
    }

    public function add(ComponentEvaluationScale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ComponentEvaluationScale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ComponentEvaluationScale[] Returns an array of ComponentEvaluationScale objects
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

//    public function findOneBySomeField($value): ?ComponentEvaluationScale
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
