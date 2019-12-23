<?php

namespace App\Model;

class DataRowModel
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int
     */
    private $passwordEncryptionKeyId;

    /**
     * @var int
     */
    private $recoveryInfoEncryptionKeyId;

    /**
     * @var int
     */
    private $ownerId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $comment;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return DataRowModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPasswordEncryptionKeyId(): ?int
    {
        return $this->passwordEncryptionKeyId;
    }

    /**
     * @param int|null $passwordEncryptionKeyId
     * @return DataRowModel
     */
    public function setPasswordEncryptionKeyId(?int $passwordEncryptionKeyId): DataRowModel
    {
        $this->passwordEncryptionKeyId = $passwordEncryptionKeyId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecoveryInfoEncryptionKeyId(): ?int
    {
        return $this->recoveryInfoEncryptionKeyId;
    }

    /**
     * @param int|null $recoveryInfoEncryptionKeyId
     * @return DataRowModel
     */
    public function setRecoveryInfoEncryptionKeyId(?int $recoveryInfoEncryptionKeyId): DataRowModel
    {
        $this->recoveryInfoEncryptionKeyId = $recoveryInfoEncryptionKeyId;
        return $this;
    }

    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    /**
     * @param int $ownerId
     * @return DataRowModel
     */
    public function setOwnerId(int $ownerId): DataRowModel
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DataRowModel
     */
    public function setName(string $name): DataRowModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return DataRowModel
     */
    public function setLogin(string $login): DataRowModel
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return DataRowModel
     */
    public function setComment(string $comment): DataRowModel
    {
        $this->comment = $comment;
        return $this;
    }

}
