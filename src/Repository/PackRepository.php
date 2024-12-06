<?php

namespace App\Repository;

use App\Entity\Pack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pack>
 */
class PackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pack::class);
    }

    public function findMonthlyPacks()
    {
        return $this->createQueryBuilder('p')
            ->where('p.duration = :duration')
            ->setParameter('duration', 'Monthly') 
            ->getQuery()
            ->getResult();
    }

 
    public function findYearlyPacks()
    {
        return $this->createQueryBuilder('p')
            ->where('p.duration = :duration')
            ->setParameter('duration', 'Yearly')  // Filter by 'yearly'
            ->getQuery()
            ->getResult();
    }
}
