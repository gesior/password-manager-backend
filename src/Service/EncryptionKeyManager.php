<?php

namespace App\Service;

use App\Entity\DataRow;
use App\Entity\EncryptionKey;
use App\Entity\User;
use App\Model\DataRowModel;
use App\Model\EncryptionKeyModel;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class EncryptionKeyManager
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    private $encryptionKeyRepository;
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->encryptionKeyRepository = $entityManager->getRepository(EncryptionKey::class);
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    /**
     * @return EncryptionKey[]
     */
    public function getList()
    {
        $list = [];

        $encryptionKeys = $this->encryptionKeyRepository->findAll();
        foreach ($encryptionKeys as $encryptionKey) {
            $list[] = $this->getEncryptionKeyModel($encryptionKey);
        }

        return $list;
    }

    /**
     * @param EncryptionKeyModel $encryptionKeyModel
     * @param User $user
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function create(EncryptionKeyModel $encryptionKeyModel, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        $encryptionKey = new EncryptionKey();
        $encryptionKey->setCreatedBy($user);
        $encryptionKey->setName($encryptionKeyModel->getName());
        $encryptionKey->setHash($encryptionKeyModel->getHash());
        $encryptionKey->setAlgorithm($encryptionKeyModel->getAlgorithm());
        $encryptionKey->setIterations($encryptionKeyModel->getIterations());
        $encryptionKey->setCreatedAt(new DateTime());

        $this->entityManager->persist($encryptionKey);
        $this->entityManager->flush();

        $encryptionKeyModel->setId($encryptionKey->getId());
    }

    /**
     * @param EncryptionKey $encryptionKey
     * @param EncryptionKeyModel $encryptionKeyModel
     * @param User $user
     * @return EncryptionKeyModel
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws Exception
     */
    public function update(EncryptionKey $encryptionKey, EncryptionKeyModel $encryptionKeyModel, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        if ($user !== $encryptionKey->getCreatedBy()) {
            throw new RuntimeException('You are not allowed to edit this encryption key.');
        }

        $encryptionKey->setName($encryptionKeyModel->getName());

        $this->entityManager->persist($encryptionKey);
        $this->entityManager->flush();

        return $encryptionKeyModel;
    }


    /**
     * @param EncryptionKey $encryptionKey
     * @return EncryptionKeyModel
     */
    public function getEncryptionKeyModel(EncryptionKey $encryptionKey)
    {
        $dataRowModel = new EncryptionKeyModel();

        $dataRowModel->setId($encryptionKey->getId());
        $dataRowModel->setName($encryptionKey->getName());
        $dataRowModel->setHash($encryptionKey->getHash());
        $dataRowModel->setAlgorithm($encryptionKey->getAlgorithm());
        $dataRowModel->setIterations($encryptionKey->getIterations());

        return $dataRowModel;
    }

}
