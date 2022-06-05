<?php

namespace App\Repository;

use App\Entity\TemplateIcons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemplateIcons>
 *
 * @method TemplateIcons|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemplateIcons|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemplateIcons[]    findAll()
 * @method TemplateIcons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemplateIconsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemplateIcons::class);
    }

    public function add(TemplateIcons $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TemplateIcons $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TemplateIcons[] Returns an array of TemplateIcons objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TemplateIcons
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
