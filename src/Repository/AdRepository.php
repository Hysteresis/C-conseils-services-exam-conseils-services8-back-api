<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ad>
 *
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function save(Ad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
   public function findByTown($townId): array
   {
    return $this->createQueryBuilder('a')
        ->join('a.town', 't')
        ->where('t.id = :townId')
        ->setParameter('townId', $townId)
        ->orderBy('a.createdAt', 'DESC')
        ->getQuery()
        ->getResult()
    ;
   }

//    public function findOneBySomeField($value): ?Ad
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
// public function findAdByLocation($location): array
// {
//      return $this->createQueryBuilder('a')
//              ->select('DISTINCT a')
//              ->where('a.location = :location')
//              ->setParameter('location', $location)
//              ->orderBy('a.createdAt', 'DESC')
//          ->getQuery()
//          ->getResult()
//     ;
// }

public function countAds(): array
{
     return $this->createQueryBuilder('a')
         ->select('COUNT(a.id)')
         ->getQuery()
         ->getResult()
    ;
}

// public function countAdByLocation($location): array
// {
//      return $this->createQueryBuilder('a')
//          ->select('COUNT(a.id)')
//          ->where('a.location = :location')
//          ->setParameter('location', $location)
//          ->getQuery()
//          ->getResult()
//     ;
// }

//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
 public function findAdByJob($job): array
 {
     return $this->createQueryBuilder('a')
             ->where('a.joblists = :joblists')
             ->setParameter('joblists', $job)
             ->orderBy('a.createdAt', 'DESC')
         ->getQuery()
         ->getResult()
     ;
 }

//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
 public function findAdByDegree($degree): array
 {
     return $this->createQueryBuilder('a')
             ->where('a.degree = :degree')
             ->setParameter('degree', $degree)
             ->orderBy('a.createdAt', 'DESC')
         ->getQuery()
         ->getResult()
     ;
 }

//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
 public function findAdBySalary($salary): array
 {
     return $this->createQueryBuilder('a')
             ->where('a.salary = :salary')
             ->setParameter('salary', $salary)
             ->orderBy('a.createdAt', 'DESC')
         ->getQuery()
         ->getResult()
     ;
 }  

 public function findAdByCompany($company): array
 {
     return $this->createQueryBuilder('a')
             
             ->join('a.recruiter', 'r')
             ->join('r.company', 'c')
             ->where('c = :company')
             ->setParameter('company', $company)
             ->orderBy('a.createdAt', 'DESC')
         ->getQuery()
         ->getResult()
     ;
 }  

//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
public function findAdByContract($contract): array
{
 return $this->createQueryBuilder('a')
         ->where('a.employmentContract = :contract')
         ->setParameter('contract', $contract)
         ->orderBy('a.createdAt', 'DESC')
     ->getQuery()
     ->getResult()
 ;
}  


 public function paginationQuery()
 {
     return $this->createQueryBuilder('a')
         ->orderBy('a.id', 'ASC')
         ->getQuery()
         ;
 }

}

