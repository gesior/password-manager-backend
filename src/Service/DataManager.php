<?php

namespace App\Service;

use App\Entity\DataRow;
use App\Entity\EncryptionKey;
use App\Entity\User;
use App\Model\DataRowModel;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class DataManager
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var ServerEncryption
     */
    private $serverEncryption;

    private $dataRowRepository;
    private $encryptionKeyRepository;
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, ServerEncryption $serverEncryption)
    {
        $this->entityManager = $entityManager;
        $this->serverEncryption = $serverEncryption;

        $this->dataRowRepository = $entityManager->getRepository(DataRow::class);
        $this->encryptionKeyRepository = $entityManager->getRepository(EncryptionKey::class);
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    /**
     * @param User $user
     * @return DataRowModel[]
     */
    public function getList(User $user)
    {
        $list = [];

        $dataRows = $this->dataRowRepository->findBy(['owner' => $user]);
        foreach ($dataRows as $dataRow) {
            $list[] = $this->getDataRowModel($dataRow);
        }

        return $list;
    }

    /**
     * @param DataRowModel $dataRowModel
     * @param User $user
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function create(DataRowModel $dataRowModel, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        $dataRow = new DataRow();
        $dataRow->setOwner($user);
        $dataRow->setName($dataRowModel->getName());
        $dataRow->setLogin('');
        $dataRow->setComment($dataRowModel->getComment());
        $dataRow->setCreatedAt(new DateTime());

        $this->entityManager->persist($dataRow);
        $this->entityManager->flush();

        $dataRow->setLogin($this->serverEncryption->encrypt($dataRowModel->getLogin(), $dataRow->getId()));
        $this->entityManager->flush();

        $dataRowModel->setId($dataRow->getId());
        $dataRowModel->setOwnerId($user->getId());
    }

    /**
     * @param DataRow $dataRow
     * @param DataRowModel $dataRowModel
     * @param User $user
     * @return DataRowModel
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws Exception
     */
    public function update(DataRow $dataRow, DataRowModel $dataRowModel, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        if ($user !== $dataRow->getOwner()) {
            throw new RuntimeException('You are not allowed to edit this data row.');
        }

        $dataRow->setName($dataRowModel->getName());
        $dataRow->setLogin($this->serverEncryption->encrypt($dataRowModel->getLogin(), $dataRow->getId()));
        $dataRow->setComment($dataRowModel->getComment());
        $dataRow->setUpdatedAt(new DateTime());

        $this->entityManager->persist($dataRow);
        $this->entityManager->flush();

        return $dataRowModel;
    }

    /**
     * @param DataRow $dataRow
     * @param User $user
     */
    public function delete(DataRow $dataRow, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        if ($user !== $dataRow->getOwner()) {
            throw new RuntimeException('You are not allowed to delete this data row.');
        }

        $this->entityManager->remove($dataRow);
        $this->entityManager->flush();
    }

    /**
     * @param DataRow $dataRow
     * @param User $user
     * @return string
     */
    public function getPassword(DataRow $dataRow, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        if ($user !== $dataRow->getOwner()) {
            throw new RuntimeException('You are not allowed to read this password.');
        }

        return $this->serverEncryption->decrypt($dataRow->getPassword(), $dataRow->getId());
    }

    /**
     * @param DataRow $dataRow
     * @param string $password
     * @param int $encryptionKeyId
     * @param User $user
     */
    public function setPassword(DataRow $dataRow, string $password, int $encryptionKeyId, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        $encryptionKey = $this->encryptionKeyRepository->find($encryptionKeyId);
        if (!$encryptionKey) {
            throw new InvalidArgumentException('EncryptionKey does not exist.');
        }

        if ($user !== $dataRow->getOwner()) {
            throw new RuntimeException('You are not allowed to set this data row password.');
        }

        $dataRow->setPasswordEncryptionKey($encryptionKey);
        $dataRow->setPassword($this->serverEncryption->encrypt($password, $dataRow->getId()));
        $this->entityManager->persist($dataRow);
        $this->entityManager->flush();
    }

    /**
     * @param DataRow $dataRow
     * @param User $user
     * @return string
     */
    public function getRecoveryInfo(DataRow $dataRow, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        if ($user !== $dataRow->getOwner()) {
            throw new RuntimeException('You are not allowed to read this recovery info.');
        }

        return $this->serverEncryption->decrypt($dataRow->getRecoveryInfo(), $dataRow->getId());
    }

    /**
     * @param DataRow $dataRow
     * @param string $recoveryInfo
     * @param int $encryptionKeyId
     * @param User $user
     */
    public function setRecoveryInfo(DataRow $dataRow, string $recoveryInfo, int $encryptionKeyId, User $user)
    {
        if (!$user) {
            throw new InvalidArgumentException('User does not exist.');
        }

        $encryptionKey = $this->encryptionKeyRepository->find($encryptionKeyId);
        if (!$encryptionKey) {
            throw new InvalidArgumentException('EncryptionKey does not exist.');
        }

        if ($user !== $dataRow->getOwner()) {
            throw new RuntimeException('You are not allowed to set this data row recovery info.');
        }

        $dataRow->setRecoveryInfoEncryptionKey($encryptionKey);
        $dataRow->setRecoveryInfo($this->serverEncryption->encrypt($recoveryInfo, $dataRow->getId()));
        $this->entityManager->persist($dataRow);
        $this->entityManager->flush();
    }

    /**
     * @param DataRow $dataRow
     * @return DataRowModel
     */
    public function getDataRowModel(DataRow $dataRow)
    {
        $dataRowModel = new DataRowModel();

        $dataRowModel->setOwnerId($dataRow->getOwner()->getId());

        if ($dataRow->getPasswordEncryptionKey()) {
            $dataRowModel->setPasswordEncryptionKeyId($dataRow->getPasswordEncryptionKey()->getId());
        } else {
            $dataRowModel->setPasswordEncryptionKeyId(null);
        }
        if ($dataRow->getRecoveryInfoEncryptionKey()) {
            $dataRowModel->setRecoveryInfoEncryptionKeyId($dataRow->getRecoveryInfoEncryptionKey()->getId());
        } else {
            $dataRowModel->setRecoveryInfoEncryptionKeyId(null);
        }

        $dataRowModel->setId($dataRow->getId());
        $dataRowModel->setName($dataRow->getName());
        $dataRowModel->setLogin($this->serverEncryption->decrypt($dataRow->getLogin(), $dataRow->getId()));
        $dataRowModel->setComment($dataRow->getComment());

        return $dataRowModel;
    }

}
