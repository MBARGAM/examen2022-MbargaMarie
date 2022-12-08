<?php

namespace App\Repository;

use App\Entity\Chanson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chanson>
 *
 * @method Chanson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chanson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chanson[]    findAll()
 * @method Chanson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChansonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chanson::class);
    }

    public function add(Chanson $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Chanson $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findAllChansons(){
        return $this->createQueryBuilder('c')
            ->orderBy('c.titre', 'ASC')
            ->distinct(True)
            ->getQuery()
            ->getResult();


    }

//    /**
//     * @return Chanson[] Returns an array of Chanson objects
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

//    public function findOneBySomeField($value): ?Chanson
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
