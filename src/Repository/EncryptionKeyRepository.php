<?php

namespace App\Repository;

use App\Entity\EncryptionKey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EncryptionKey|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncryptionKey|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncryptionKey|null findOneByEmail(string $email)
 * @method EncryptionKey[]    findAll()
 * @method EncryptionKey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncryptionKeyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EncryptionKey::class);
    }

}
