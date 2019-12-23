<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DataRowRepository")
 */
class DataRow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="dataRows")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $owner;

    /**
     * @var EncryptionKey|null
     *
     * @ORM\ManyToOne(targetEntity="EncryptionKey", inversedBy="dataRowPasswords")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="password_encryption_key_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $passwordEncryptionKey;

    /**
     * @var EncryptionKey|null
     *
     * @ORM\ManyToOne(targetEntity="EncryptionKey", inversedBy="dataRowRecoveryInfos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recovery_info_encryption_key_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $recoveryInfoEncryptionKey;

    /**
     * @var string
     * @ORM\Column(type="string", length=180)
     */
    private $name = '';

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $login = '';

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $password = '';

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $comment = '';

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $recoveryInfo = '';

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt = null;

    /**
     * @var ?DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return DataRow
     */
    public function setOwner(User $owner): DataRow
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return EncryptionKey|null
     */
    public function getPasswordEncryptionKey(): ?EncryptionKey
    {
        return $this->passwordEncryptionKey;
    }

    /**
     * @param EncryptionKey|null $passwordEncryptionKey
     * @return DataRow
     */
    public function setPasswordEncryptionKey(?EncryptionKey $passwordEncryptionKey): DataRow
    {
        $this->passwordEncryptionKey = $passwordEncryptionKey;
        return $this;
    }

    /**
     * @return EncryptionKey|null
     */
    public function getRecoveryInfoEncryptionKey(): ?EncryptionKey
    {
        return $this->recoveryInfoEncryptionKey;
    }

    /**
     * @param EncryptionKey|null $recoveryInfoEncryptionKey
     * @return DataRow
     */
    public function setRecoveryInfoEncryptionKey(?EncryptionKey $recoveryInfoEncryptionKey): DataRow
    {
        $this->recoveryInfoEncryptionKey = $recoveryInfoEncryptionKey;
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
     * @return DataRow
     */
    public function setName(string $name): DataRow
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
     * @return DataRow
     */
    public function setLogin(string $login): DataRow
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return DataRow
     */
    public function setPassword(string $password): DataRow
    {
        $this->password = $password;
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
     * @return DataRow
     */
    public function setComment(string $comment): DataRow
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecoveryInfo(): string
    {
        return $this->recoveryInfo;
    }

    /**
     * @param string $recoveryInfo
     * @return DataRow
     */
    public function setRecoveryInfo(string $recoveryInfo): DataRow
    {
        $this->recoveryInfo = $recoveryInfo;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return DataRow
     */
    public function setCreatedAt(DateTime $createdAt): DataRow
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return DataRow
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}
