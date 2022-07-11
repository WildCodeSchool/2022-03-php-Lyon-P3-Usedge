<?php

namespace App\Repository;

use App\Entity\ResearchPlanSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResearchPlanSection>
 *
 * @method ResearchPlanSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResearchPlanSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResearchPlanSection[]    findAll()
 * @method ResearchPlanSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResearchPlanSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResearchPlanSection::class);
    }

    public function add(ResearchPlanSection $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ResearchPlanSection $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ResearchPlanSection[] Returns an array of ResearchPlanSection objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResearchPlanSection
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
