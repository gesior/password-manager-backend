<?php

namespace App\Repository;

use App\Entity\DataRow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DataRow|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataRow|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataRow|null findOneByEmail(string $email)
 * @method DataRow[]    findAll()
 * @method DataRow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataRowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DataRow::class);
    }

}
